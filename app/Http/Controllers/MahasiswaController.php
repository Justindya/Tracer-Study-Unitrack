<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data['mahasiswas'] = User::where('role', 'mahasiswa')->latest()->paginate(10);
        return view('admin.mahasiswa_index', $data);
    }

    public function create()
    {
        return view('admin.mahasiswa_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nim' => 'required|unique:users|unique:alumnis',
            'email' => 'required|email|unique:users|unique:alumnis',
            'password' => 'required|min:6|confirmed',
            'angkatan' => 'required',
            'program_studi' => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        // Buat Profil di tabel alumnis (berlaku sebagai tabel profil umum)
        $alumni = \App\Models\alumni::create([
            'nama' => $validated['name'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'no_hp' => '-',
            'angkatan' => $validated['angkatan'],
            'tahun_lulus' => '-',
            'program_studi' => $validated['program_studi'],
            'password' => Hash::make($validated['password']),
            'jenis_kelamin' => $validated['jenis_kelamin'], 
            'alamat' => '-',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nim' => $validated['nim'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
            'status' => 'active', 
            'alumni_id' => $alumni->id
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $data['mahasiswa'] = User::findOrFail($id);
        return view('admin.mahasiswa_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $alumni = $user->alumni;

        $validated = $request->validate([
            'name' => 'required',
            'nim' => [
                'required',
                'unique:users,nim,' . $id,
                'unique:alumnis,nim,' . ($alumni ? $alumni->id : 'NULL')
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $id,
                'unique:alumnis,email,' . ($alumni ? $alumni->id : 'NULL')
            ],
            'password' => 'nullable|min:6|confirmed',
            'angkatan' => 'required',
            'program_studi' => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nim' => $validated['nim'],
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        if ($alumni) {
            $alumni->update([
                'nama' => $validated['name'],
                'email' => $validated['email'],
                'nim' => $validated['nim'],
                'angkatan' => $validated['angkatan'],
                'program_studi' => $validated['program_studi'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
            ]);
            if (isset($userData['password'])) {
                $alumni->update(['password' => $userData['password']]);
            }
        }

        // Cek jika sudah lulus (Tahun lulus diisi selain '-')
        if ($request->filled('tahun_lulus') && $request->tahun_lulus != '-' && $user->role == 'mahasiswa') {
            $user->update(['role' => 'alumni']);
            if ($alumni) {
                $alumni->update(['tahun_lulus' => $request->tahun_lulus]);
            }
        } elseif ($request->tahun_lulus == '-' && $user->role == 'alumni') {
            // Jika dikembalikan ke status mahasiswa
            $user->update(['role' => 'mahasiswa']);
            if ($alumni) {
                $alumni->update(['tahun_lulus' => '-']);
            }
        }

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus!');
    }
}
