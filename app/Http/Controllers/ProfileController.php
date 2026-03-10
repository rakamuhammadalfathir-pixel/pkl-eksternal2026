<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user')); 
    }
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'telepon' => 'nullable|numeric',
            'alamat'  => 'nullable|string',
            'avatar'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password'=> 'nullable|min:8|confirmed',
        ]);

        $data = $request->only(['name', 'email', 'telepon', 'alamat']);

        // Logika simpan foto profil
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $namaFile = time() . '_' . $user->name . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $namaFile);
            $data['avatar'] = $namaFile;
        }

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        if ($user->role == 'customer') { 
            Anggota::where('user_id', $user->id)->update([
                'nama'    => $request->name,
                'telepon' => $request->telepon,
                'alamat'  => $request->alamat,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
