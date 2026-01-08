<?php

namespace App\Http\Controllers;

use App\Models\TitipTulisan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TitipTulisanController extends Controller
{
    /**
     * Public Page - Home / List
     */
    public function index()
    {
        $latest = TitipTulisan::where('status', 'accept')->latest()->get();

        $popular = TitipTulisan::where('status', 'accept')
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
        $validated = $request->validate([
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
            'status' => 'pending',
            'slug' => Str::slug($request->judul),
        ]);

        return redirect()->back()->with('success', 'Tulisan berhasil dikirim! Menunggu review.');
    }

    /**
     * Public Detail View
     */
    public function show(TitipTulisan $titipTulisan)
    {
        if (strtolower($titipTulisan->status) !== 'accept') {
            abort(404);
        }

        $random = TitipTulisan::where('status', 'accept')
            ->where('id', '!=', $titipTulisan->id)
            ->inRandomOrder()
            ->take(2)
            ->get();

        $titipTulisan->increment('views');

        return view('titip-tulisan.show', compact('titipTulisan', 'random'));
    }

    /**
     * Admin Page - Manage List
     */
    public function manage()
    {
        $all = TitipTulisan::with('category')->latest()->get();
        return view('titip-tulisan.manage', compact('all'));
    }

    /**
     * Admin - Status List
     */
    public function status()
    {
        $pending = TitipTulisan::with('category')
            ->whereIn('status', ['pending', 'reject'])
            ->latest()
            ->get();

        return view('titip-tulisan.status', compact('pending'));
    }

    /**
     * Admin - View Single
     */
    public function view($id)
    {
        $titipTulisan = TitipTulisan::with('category')->findOrFail($id);
        return view('titip-tulisan.view', compact('titipTulisan'));
    }

    /**
     * Admin - Update Status
     * REVISI DI SINI: Validasi diperlonggar untuk menerima huruf Besar dan Kecil
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi menerima: Pending, Accept, Reject (Huruf Besar) ATAU pending, accept, reject (Huruf Kecil)
        $request->validate([
            'status' => 'required|in:Pending,Accept,Reject,pending,accept,reject'
        ]);

        $titipTulisan = TitipTulisan::findOrFail($id);
        $oldStatus = $titipTulisan->status;

        // Kita konversi input menjadi huruf kecil semua sebelum disimpan ke Database
        $newStatus = strtolower($request->status);

        $titipTulisan->update(['status' => $newStatus]);

        $redirectUrl = $newStatus === 'accept'
            ? route('admin.titip-tulisan.manage')
            : route('admin.titip-tulisan.status');

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui dari ' . $oldStatus . ' menjadi ' . $newStatus . '!',
            'redirect_url' => $redirectUrl
        ]);
    }

    /**
     * Admin - Delete
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
