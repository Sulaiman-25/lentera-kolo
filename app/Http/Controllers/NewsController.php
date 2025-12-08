<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Events\NewsCreated;
use Illuminate\Http\Request;
use App\Events\NewsStatusUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar berita.
     */
    public function index()
    {
        $latestNews = News::where('status', 'Accept')->latest()->get();
        $topNews = News::where('status', 'Accept')->orderBy('views', 'desc')->get();
        $popularNews = News::where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->get();
        $topCategory = Category::orderBy('views', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home', compact(
            'latestNews',
            'topNews',
            'popularNews',
            'topCategory',
        ));
    }

    /**
     * Mengelola berita untuk admin.
     */
    public function manage()
    {
        $allNews = News::with(['category', 'author'])->latest()->get();
        return view('admin.news.manage', compact('allNews'));
    }

    /**
     * Menampilkan berita berdasarkan kategori.
     */
    public function viewCategory(Category $categories)
    {
        $latestNews = $categories->news()->where('status', 'Accept')->latest()->get();
        $topNews = $categories->news()->where('status', 'Accept')->orderBy('views', 'desc')->get();
        $popularNews = $categories->news()
            ->where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->get();

        $categories->increment('views');

        return view('viewCategory', compact('categories', 'latestNews', 'topNews', 'popularNews'));
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        $allCategory = Category::all();
        return view('news.create', compact('allCategory'));
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|min:1|unique:news,title',
                'content' => 'required|string|min:1',
                'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
                'category_id' => 'required|exists:category,id',
            ]);

            $imageHashName = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageHashName = $image->hashName();
                $image->storeAs('public/images', $imageHashName);
            }

            $news = News::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
                'category_id' => $request->input('category_id'),
                'image' => $imageHashName,
            ]);

            event(new NewsCreated($news));

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil disimpan.',
                'redirect_url' => route('dashboard')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail berita.
     */
    public function show(News $news)
    {
        $randomNews = News::inRandomOrder()->take(2)->get();
        $news->increment('views');

        return view('detail', compact('news', 'randomNews'));
    }

    /**
     * Menampilkan form untuk mengedit berita.
     */
    public function edit(News $news)
    {
        $allCategory = Category::all();

        if ($news->status != 'Reject') {
            return redirect()->route('admin.news.manage')->with('error', 'Berita hanya dapat diedit jika statusnya ditolak.');
        }

        return view('news.edit', compact('news', 'allCategory'));
    }

    /**
     * Memperbarui berita di database.
     */
    public function update(Request $request, News $news)
    {
        try {
            // Validasi hanya untuk berita yang ditolak
            if ($news->status != 'Reject') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya berita yang ditolak yang dapat diedit.'
                ], 403);
            }

            $request->validate([
                'title' => 'required|string|max:255|unique:news,title,' . $news->id,
                'content' => 'required|string|min:10',
                'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
                'category_id' => 'required|exists:category,id'
            ]);

            $data = [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'category_id' => $request->input('category_id'),
                'status' => 'Pending',
                'updated_at' => now(),
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageHashName = $image->hashName();
                $image->storeAs('public/images', $imageHashName);

                // Hapus gambar lama jika ada
                if ($news->image) {
                    Storage::delete('public/images/' . $news->image);
                }

                $data['image'] = $imageHashName;
            }

            $news->update($data);

            event(new NewsCreated($news));

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil diperbarui dan status direset ke Pending.',
                'redirect_url' => route('dashboard')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus berita dari database.
     */
    public function destroy($id)
    {
        try {
            $news = News::findOrFail($id);

            if ($news->image) {
                Storage::delete('public/images/' . $news->image);
            }

            $news->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dihapus.',
                'redirect_url' => route('admin.news.manage')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan halaman pengelolaan status berita.
     */
    public function status()
    {
        $draftNews = News::with(['category', 'author'])
            ->whereIn('status', ['Pending', 'Reject'])
            ->latest()
            ->get();

        return view('news.status', compact('draftNews'));
    }

    /**
     * Melihat detail berita untuk pengelolaan status.
     */
    public function view(News $news)
    {
        $news->load(['category', 'author']);
        return view('news.view', compact('news'));
    }

    /**
     * Memperbarui status berita (Accept/Reject).
     */
    public function updateStatus(Request $request, $id)
    {
        \Log::info('UpdateStatus dipanggil', ['id' => $id, 'status' => $request->status]);

        try {
            // Validasi input
            $validated = $request->validate([
                'status' => 'required|in:Accept,Reject'
            ]);

            \Log::info('Validasi berhasil', $validated);

            // Cari berita
            $news = News::findOrFail($id);
            \Log::info('Berita ditemukan', ['id' => $news->id, 'judul' => $news->title, 'status_lama' => $news->status]);

            // Simpan status lama
            $oldStatus = $news->status;

            // Perbarui status
            $news->status = $request->status;
            $news->save();

            \Log::info('Berita diperbarui', ['status_baru' => $news->status]);

            // Trigger event
            event(new NewsStatusUpdated($news, $oldStatus));

            \Log::info('Event dijalankan');

            // Return JSON response untuk AJAX
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui! Status berita "' . $news->title . '" sekarang: ' .
                             ($request->status == 'Accept' ? 'Diterima' : 'Ditolak'),
                'redirect_url' => route('admin.news.status'),
                'data' => [
                    'id' => $news->id,
                    'title' => $news->title,
                    'old_status' => $oldStatus,
                    'new_status' => $news->status,
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Error validasi', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Berita tidak ditemukan', ['id' => $id]);
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error('Error Update Status', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menampilkan draft berita pengguna.
     */
    public function draft()
    {
        $userId = auth()->id();

        $acceptedNews = News::with('category')
            ->where('status', 'Accept')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        $notAcceptedNews = News::with('category')
            ->whereIn('status', ['Pending', 'Reject'])
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('admin.users.draft', compact('acceptedNews', 'notAcceptedNews'));
    }
}
