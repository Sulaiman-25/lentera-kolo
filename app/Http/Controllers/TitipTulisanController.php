<?php

namespace App\Http\Controllers;

use App\Models\TitipTulisan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TitipTulisanController extends Controller
{
    /**
     * Public Page - Home / List
     */
    public function index()
    {
        $latest = TitipTulisan::where('status', 'Accept')->latest()->get();
        $popular = TitipTulisan::where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->get();

        $categories = Category::orderBy('views', 'desc')->get();

        return view('home', compact('latest', 'popular', 'categories'));
    }

    /**
     * Public - Create Form
     */
    public function create()
    {
        $categories = Category::all();
        return view('titip-tulisan.create', compact('categories'));
    }

    /**
     * Public - Store Submission
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required|string|max:255',
            'email_pengirim' => 'required|email',
            'judul' => 'required|string|min:3|unique:titip_tulisans,judul',
            'isi' => 'required|string|min:10',
            'category_id' => 'required|exists:category,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $imageHashName = null;
        if ($request->hasFile('image')) {
            $imageHashName = $request->file('image')->hashName();
            $request->file('image')->storeAs('public/titip-tulisan', $imageHashName);
        }

        TitipTulisan::create([
            'nama_pengirim' => $request->nama_pengirim,
            'email_pengirim' => $request->email_pengirim,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'category_id' => $request->category_id,
            'image' => $imageHashName,
        ]);

        return redirect()->back()->with('success', 'Tulisan berhasil dikirim! Menunggu review.');
    }

    /**
     * Public Detail View
     */
    public function show(TitipTulisan $titipTulisan)
    {
        // Cek apakah status Accept
        if ($titipTulisan->status !== 'Accept') {
            abort(404);
        }

        // Get random titip tulisan lainnya
        $random = TitipTulisan::where('status', 'Accept')
            ->where('id', '!=', $titipTulisan->id)
            ->inRandomOrder()
            ->take(2)
            ->get();

        // Increment views
        $titipTulisan->increment('views');

        return view('titip-tulisan.show', compact('titipTulisan', 'random'));
    }

    /**
     * Admin Page - Manage List (HANYA ACCEPT)
     */
    public function manage()
    {
        $all = TitipTulisan::with('category')
            ->where('status', 'Accept')
            ->get();
        return view('titip-tulisan.manage', compact('all'));
    }

    /**
     * Admin - Status List (PENDING/REJECT)
     */
    public function status()
    {
        $pending = TitipTulisan::with('category')
            ->whereIn('status', ['Pending', 'Reject'])
            ->get();
        return view('titip-tulisan.status', compact('pending'));
    }

    /**
     * Admin - View Single (untuk semua status)
     */
    public function view($id)
    {
        $titipTulisan = TitipTulisan::with('category')->findOrFail($id);
        return view('titip-tulisan.view', compact('titipTulisan'));
    }

    /**
     * Admin - Update Status (AJAX + SweetAlert)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accept,Reject'
        ]);

        $titipTulisan = TitipTulisan::findOrFail($id);
        $oldStatus = $titipTulisan->status;
        $titipTulisan->update(['status' => $request->status]);

        $redirectUrl = $request->status === 'Accept'
            ? route('admin.titip-tulisan.manage')
            : route('admin.titip-tulisan.status');

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui dari ' . $oldStatus . ' menjadi ' . $request->status . '!',
            'redirect_url' => $redirectUrl
        ]);
    }

    /**
     * Admin - Delete (AJAX + SweetAlert)
     */
    public function destroy($id)
    {
        $titipTulisan = TitipTulisan::findOrFail($id);

        if ($titipTulisan->image) {
            Storage::delete('public/titip-tulisan/' . $titipTulisan->image);
        }

        $titipTulisan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tulisan berhasil dihapus!',
            'redirect_url' => route('admin.titip-tulisan.manage')
        ]);
    }
}
