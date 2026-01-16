<?php

namespace App\Http\Controllers;

use App\Models\user_alumni;
use App\Models\alumni; // Pastikan model ini benar
use App\Http\Requests\Storeuser_alumniRequest;
use App\Http\Requests\Updateuser_alumniRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // LOGIKA BARU: Mengambil BANYAK data alumni untuk fitur Network
        $query = alumni::query();

        // Fitur Search (Nama, Prodi, atau Angkatan)
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('program_studi', 'like', "%{$search}%")
                  ->orWhere('angkatan', 'like', "%{$search}%");
            });
        }

        // Filter Jurusan (Jika diklik dari sidebar)
        if ($request->has('jurusan')) {
            $query->where('program_studi', 'like', "%{$request->jurusan}%");
        }

        // Ambil data (Pagination 9 per halaman biar rapi grid 3x3)
        // latest() agar yang baru daftar muncul duluan
        $alumni = $query->latest()->paginate(9);

        // Kita return ke view yang sama, tapi variabel $alumni isinya sekarang BANYAK data
        return view('user.alumni_index', compact('alumni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeuser_alumniRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tetap pakai logika asli V3 untuk detail
        $alumni = alumni::findOrFail($id);
        return view('user.alumni_show', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Logika edit profil sendiri (hanya bisa edit punya sendiri)
        $user = Auth::user();
        $alumni = alumni::where('nim', $user->nim)->firstOrFail();

        if ($alumni->id != $id) {
            abort(403, 'Unauthorized action.');
        }
        return view('user.alumni_edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $alumni = alumni::where('nim', $user->nim)->firstOrFail();

        if ($alumni->id != $id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:alumnis,nim,' . $id,
            'email' => 'required|email|unique:alumnis,email,' . $id,
            'no_hp' => 'required',
            'angkatan' => 'required',
            'tahun_lulus' => 'required',
            'program_studi' => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required',
            'Foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('Foto')) {
            if ($alumni->Foto) {
                Storage::disk('public')->delete($alumni->Foto);
            }
            $validated['Foto'] = $request->file('Foto')->store('alumni', 'public');
        }

        $alumni->update($validated);

        $user->update([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'nim' => $validated['nim']
        ]);

        // Redirect kembali ke dashboard atau index setelah edit
        return redirect()->route('user.alumni.index')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_alumni $user_alumni)
    {
        //
    }
}