<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Mengembalikan respons dalam format JSON
        return response()->json([
            'users' => $user
        ]);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'new_password' => 'required|string|min:4|confirmed',
        ]);

        // Simpan password baru
        $user->update([
            'password' => bcrypt($request->input('new_password')),
            'new_password' => null, // Reset kolom new_password ke null setelah konfirmasi
        ]);

        return redirect()->back()->with('success', 'berhasil diperbarui!');
    }
}
