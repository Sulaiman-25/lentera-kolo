<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     */
    public function index()
    {
        $roles = Role::all();
        $allUsers = User::with('roles', 'news')->get();
        return view('admin.users.manage', compact('allUsers', 'roles'));
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     */
    public function create()
    {
        //
    }

    /**
     * Menyimpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Menampilkan detail pengguna tertentu.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Menampilkan form untuk mengedit profil pengguna.
     */
    public function edit(User $user)
    {
        if (Auth::id() !== $user->id) {
            abort(403, 'Aksi tidak diizinkan.');
        }
        return view('admin.profile', compact('user'));
    }

    /**
     * Memperbarui data profil pengguna.
     */
    public function update(Request $request, User $user)
    {
        try {

            if (Auth::id() !== $user->id) {
                abort(403, 'Aksi tidak diizinkan.');
            }

            $request->validate([
                'name' => 'sometimes|string|max:255',
                'bio' => 'nullable|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = [
                'name' => $request->name,
                'bio' => $request->bio,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->storeAs('public/images/', $image->hashName());

                Storage::delete('public/images/' . $user->image);

                $data['image'] = $image->hashName();
            }

            $user->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui.',
                'redirect_url' => route('dashboard', $user->id)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy(User $user)
    {
        try {
            if ($user->image) {
                Storage::delete('public/images/' . $user->image);
            }

            foreach ($user->news as $news) {
                if ($news->image) {
                    Storage::delete('public/images/' . $news->image);
                }
            }

            $user->news()->delete();
            $user->notifications()->delete();

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengguna berhasil dihapus.',
                'redirect_url' => route('admin.users.manage')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Menetapkan atau memperbarui peran pengguna.
     */
    public function assignRole(Request $request, User $user)
    {
        try {
            $request->validate([
                'role' => 'required:exist:roles,id'
            ]);

            $roleId = $request->input('role');
            $role = Role::findOrFail($roleId);

            $user->syncRoles([$role]);

            return response()->json([
                'success' => true,
                'message' => 'Peran pengguna berhasil diperbarui.',
                'redirect_url' => route('admin.users.manage')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
