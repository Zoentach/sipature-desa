<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Absensi;
use App\Models\User;
use App\Models\VerifikasiAbsensi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna dengan sistem paginasi.
     */
    public function index()
    {
        // Mengambil data user diurutkan dari yang terbaru, 10 data per halaman
        $users = User::latest()->paginate(10);

        return view('admin.pengguna.index', compact('users'));
    }

    /**
     * Menampilkan form untuk menambah satu pengguna baru.
     */
    public function tambah()
    {
        return view('admin.pengguna.tambah');
    }

    /**
     * Menyimpan data satu pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'], // Otomatis di-hash oleh model casting
        ]);

        return redirect()->route('admin.pengguna.tambah')->with('success', 'User dan password berhasil dibuat!');
    }

    /**
     * Menampilkan form untuk import CSV.
     */
    public function importForm()
    {
        return view('admin.pengguna.import');
    }

    /**
     * Memproses file CSV dan memasukkan banyak user sekaligus ke database.
     */
    public function importStore(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt', 'max:2048'],
        ]);

        $file = $request->file('file');

        try {
            if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
                try {
                    $header = true;
                    $existingEmails = User::pluck('email')->toArray();

                    while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                        if ($header) {
                            $header = false;
                            continue;
                        }

                        $name = trim($row[0] ?? '');
                        $email = trim($row[1] ?? '');
                        $password = trim($row[2] ?? '');

                        if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
                            if (!in_array($email, $existingEmails)) {
                                User::create([
                                    'name' => $name,
                                    'email' => $email,
                                    'password' => $password,
                                ]);

                                $existingEmails[] = $email;
                            }
                        }
                    }
                } finally {
                    fclose($handle);
                }
            }

            return redirect()->route('pengguna.index')->with('success', 'Data user berhasil di-import dengan aman!');

        } catch (\Exception $e) {
            // Jika ada kesalahan struktur file atau database, tangkap di sini
            return redirect()->back()->with('error', 'Gagal memproses file: ' . $e->getMessage());
        }
    }
}
