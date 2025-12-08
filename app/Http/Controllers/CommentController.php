<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Models\TitipTulisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of comments (Super Admin, Editor, Writer)
     */
    public function index()
    {
        $user = Auth::user();

        // Super Admin bisa melihat semua komentar
        if ($user->hasRole('Super Admin')) {
            $comments = Comment::with(['commentable', 'user'])
                ->latest()
                ->paginate(20);

            $deletedComments = Comment::onlyTrashed()
                ->with(['commentable', 'user'])
                ->latest()
                ->get();

            return view('admin.comments.index', compact('comments', 'deletedComments'));
        }

        // Editor bisa melihat semua komentar dari News/Berita
        if ($user->hasRole('Editor')) {
            $comments = Comment::with(['commentable', 'user'])
                ->where('commentable_type', News::class)
                ->latest()
                ->paginate(20);

            $deletedComments = collect(); // Editor tidak bisa lihat komentar terhapus
            return view('admin.comments.index', compact('comments', 'deletedComments'));
        }

        // Writer hanya bisa melihat komentar dari berita yang mereka buat
        if ($user->hasRole('Writer')) {
            $myNewsIds = News::where('user_id', $user->id)->pluck('id');

            $comments = Comment::with(['commentable', 'user'])
                ->where('commentable_type', News::class)
                ->whereIn('commentable_id', $myNewsIds)
                ->latest()
                ->paginate(20);

            $deletedComments = collect(); // Writer tidak bisa lihat komentar terhapus
            return view('admin.comments.index', compact('comments', 'deletedComments'));
        }

        abort(403, 'Unauthorized');
    }

    /**
     * Store a newly created comment (All users - logged in or not)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|min:3|max:2000',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'commentable_type' => 'required|string|in:news,titip-tulisan',
            'commentable_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        // Cek model yang dikomentari
        if ($request->commentable_type === 'news') {
            $commentable = News::find($request->commentable_id);
            $redirectRoute = 'news.show';
            $routeParams = ['news' => $commentable->slug];
        } else {
            $commentable = TitipTulisan::find($request->commentable_id);
            $redirectRoute = 'titip-tulisan.show';
            $routeParams = ['titip_tulisan' => $commentable->slug];
        }

        if (!$commentable) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Postingan tidak ditemukan'], 404);
            }
            return back()->with('error', 'Postingan tidak ditemukan');
        }

        $commentData = [
            'content' => $request->input('content'),
            'commentable_type' => $request->input('commentable_type') === 'news' ? News::class : TitipTulisan::class,
            'commentable_id' => $request->input('commentable_id'),
        ];

        if (Auth::check()) {
            $commentData['user_id'] = Auth::id();
            $commentData['name'] = Auth::user()->name;
            $commentData['email'] = Auth::user()->email;
        } else {
            $commentData['name'] = $request->name ?: 'Anonim';
            $commentData['email'] = $request->email ?: '';
        }

        $comment = Comment::create($commentData);

        if ($request->expectsJson()) {
            $comment->load('user');
            return response()->json(['success' => true, 'message' => 'Komentar berhasil ditambahkan', 'comment' => $comment], 201);
        }

        return redirect()->route($redirectRoute, $routeParams)->with('success', 'Komentar berhasil ditambahkan');
    }

    /**
     * Display comments for a specific item (API)
     */
    public function getComments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'commentable_type' => 'required|string|in:news,titip-tulisan',
            'commentable_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $type = $request->commentable_type === 'news' ? News::class : TitipTulisan::class;

        $comments = Comment::with('user')
            ->where('commentable_type', $type)
            ->where('commentable_id', $request->commentable_id)
            ->whereNull('deleted_at')
            ->latest()
            ->paginate(10);

        return response()->json(['success' => true, 'comments' => $comments]);
    }

    /**
     * Delete a comment
     */
    public function destroy(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return $request->expectsJson()
                ? response()->json(['success' => false, 'message' => 'Komentar tidak ditemukan'], 404)
                : back()->with('error', 'Komentar tidak ditemukan');
        }

        $user = Auth::user();

        if ($user->hasRole('Super Admin')) {
            $comment->delete();
        } elseif ($user->hasRole('Editor')) {
            if ($comment->commentable_type !== News::class) abort(403, 'Unauthorized - Editor hanya bisa menghapus komentar dari berita');
            $comment->delete();
        } elseif ($user->hasRole('Writer')) {
            if ($comment->commentable_type !== News::class) abort(403, 'Unauthorized');
            $news = News::find($comment->commentable_id);
            if (!$news || $news->user_id !== $user->id) abort(403, 'Unauthorized - Anda hanya bisa menghapus komentar dari berita Anda sendiri');
            $comment->delete();
        } else {
            abort(403, 'Unauthorized');
        }

        return $request->expectsJson()
            ? response()->json(['success' => true, 'message' => 'Komentar berhasil dihapus'])
            : back()->with('success', 'Komentar berhasil dihapus');
    }

    /**
     * Restore a deleted comment (Super Admin only)
     */
    public function restore($id)
    {
        $user = Auth::user();
        if (!$user->hasRole('Super Admin')) abort(403, 'Unauthorized - Hanya Super Admin yang bisa restore komentar');

        $comment = Comment::withTrashed()->find($id);
        if (!$comment) return back()->with('error', 'Komentar tidak ditemukan');

        $comment->restore();
        return back()->with('success', 'Komentar berhasil dipulihkan');
    }

    /**
     * Permanently delete a comment (Super Admin only)
     */
    public function forceDelete($id)
    {
        $user = Auth::user();
        if (!$user->hasRole('Super Admin')) abort(403, 'Unauthorized');

        $comment = Comment::withTrashed()->find($id);
        if (!$comment) return back()->with('error', 'Komentar tidak ditemukan');

        $comment->forceDelete();
        return back()->with('success', 'Komentar berhasil dihapus permanen');
    }

    /**
     * Show comments for specific news (Editor & Writer)
     */
    public function newsComments($newsId)
    {
        $user = Auth::user();
        if (!$user->hasRole('Super Admin') && !$user->hasRole('Editor') && !$user->hasRole('Writer')) abort(403, 'Unauthorized');

        $news = News::findOrFail($newsId);

        // Writer hanya bisa melihat komentar dari berita mereka sendiri
        if ($user->hasRole('Writer') && !$user->hasRole('Super Admin') && !$user->hasRole('Editor')) {
            if ($news->user_id !== $user->id) abort(403, 'Unauthorized - Anda hanya bisa melihat komentar dari berita Anda sendiri');
        }

        $comments = Comment::with('user')
            ->where('commentable_type', News::class)
            ->where('commentable_id', $newsId)
            ->latest()
            ->paginate(20);

        return view('admin.comments.news-comments', compact('news', 'comments'));
    }

    /**
     * Show list of my news for Writer/Editor to select
     */
    public function myNewsComments()
    {
        $user = Auth::user();
        if (!$user->hasRole('Super Admin') && !$user->hasRole('Editor') && !$user->hasRole('Writer')) abort(403, 'Unauthorized');

        $newsList = News::where('user_id', $user->id)
            ->withCount(['comments as comment_count' => function($query) {
                $query->where('commentable_type', News::class);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.comments.my-news-list', compact('newsList'));
    }
}
