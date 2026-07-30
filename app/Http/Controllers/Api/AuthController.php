<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pegawai;

// Pastikan Model Pegawai di-import
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Kredensial salah'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // CARI DATA PEGAWAI BERDASARKAN USER_ID
        $pegawai = Pegawai::where('user_id', $user->id)->first();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                // Mengirim data pegawai ke Android jika ditemukan
                'pegawai_id' => $pegawai ? $pegawai->id : null,
                'nama' => $pegawai ? $pegawai->nama : $user->name,
                'jabatan' => $pegawai ? $pegawai->jabatan : null
            ]
        ]);
    }

    public function logout(Request $request)
    {
        // Menghapus token saat ini yang digunakan oleh user
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil keluar (Logout). Token telah dicabut.'
        ], 200);
    }
}
