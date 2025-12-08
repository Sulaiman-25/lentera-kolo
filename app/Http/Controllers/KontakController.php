<?php

namespace App\Http\Controllers;

use App\Models\kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource (Superadmin).
     */
    public function index()
    {
        $contacts = kontak::latest()->paginate(10);
        return view('kontak.index', compact('contacts'));
    }

    /**
     * Store a newly created resource from user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        kontak::create($validated);

        return redirect()->back()->with('success', 'Pesan berhasil terkirim!');
    }

    /**
     * Show the form for editing the specified resource (Superadmin).
     */

    /**
     * Remove the specified resource (Superadmin).
     */
    public function destroy($id)
    {
        kontak::findOrFail($id)->delete();

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}
