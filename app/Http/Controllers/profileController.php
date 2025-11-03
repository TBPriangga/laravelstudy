<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    // 🧭 Menampilkan halaman profile
    public function show()
    {
        return view('profile');
    }

    // 🛠️ Update profile (nama, email, password, dan avatar)
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update nama & email
        $user->name = $request->name;
        $user->email = $request->email;

        // 🔐 Ganti password (jika diisi)
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            $user->password = Hash::make($request->new_password);
        }

        // 🖼️ Ganti avatar (jika ada file diunggah)
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::exists(str_replace('storage/', '', $user->avatar))) {
                Storage::delete(str_replace('storage/', '', $user->avatar));
            }

            // Simpan avatar baru di storage/public/avatars/
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = 'storage/' . $path;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    // 🗑️ Hapus foto profil
    public function deleteAvatar()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->avatar && Storage::exists(str_replace('storage/', '', $user->avatar))) {
            Storage::delete(str_replace('storage/', '', $user->avatar));
        }

        $user->avatar = null;
        $user->save();

        return back()->with('success', 'Profile picture removed successfully.');
    }

    // ❌ Hapus akun pengguna
    public function deleteAccount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Hapus avatar dari storage jika ada
        if ($user->avatar && Storage::exists(str_replace('storage/', '', $user->avatar))) {
            Storage::delete(str_replace('storage/', '', $user->avatar));
        }

        // Logout dulu sebelum delete
        Auth::logout();

        // Hapus akun user
        $user->delete();

        return redirect('/register')->with('success', 'Your account has been permanently deleted.');
    }
}
