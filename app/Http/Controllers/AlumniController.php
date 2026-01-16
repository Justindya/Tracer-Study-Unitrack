<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Exports\AlumniExport;
use App\Exports\SingleAlumniExport;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['alumnis'] = \App\Models\alumni::latest()->paginate(10);
        // layouts.app dan navigation otomatis dipakai di resources/views/admin/alumni_index.blade.php
        return view('admin.alumni_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // layouts.app dan navigation otomatis dipakai di resources/views/admin/alumni_register.blade.php
        return view('admin.alumni_register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:alumnis',
            'email' => 'required|email|unique:alumnis',
            'no_hp' => 'required',
            'angkatan' => 'required',
            'tahun_lulus' => 'required',
            'program_studi' => 'required',
            'password' => 'required|min:6|confirmed',
            'Foto' => 'nullable|image',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('Foto')) {
            $validated['Foto'] = $request->file('Foto')->store('alumni', 'public');
        }

        // Create alumni record
        $alumni = \App\Models\alumni::create($validated);

        // Create user account for the alumni
        User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'nim' => $validated['nim'],
            'password' => $validated['password'],
            'role' => 'alumni',
            'alumni_id' => $alumni->id
        ]);

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['alumni'] = \App\Models\alumni::findOrFail($id);
        // layouts.app dan navigation otomatis dipakai di resources/views/admin/alumni_show.blade.php
        return view('admin.alumni_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['alumni'] = \App\Models\alumni::findOrFail($id);
        // layouts.app dan navigation otomatis dipakai di resources/views/admin/alumni_edit.blade.php
        return view('admin.alumni_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alumni = \App\Models\alumni::findOrFail($id);

        $rules = [
            'nama' => 'required',
            'nim' => 'required|unique:alumnis,nim,' . $id,
            'email' => 'required|email|unique:alumnis,email,' . $id,
            'no_hp' => 'required',
            'angkatan' => 'required',
            'tahun_lulus' => 'required',
            'program_studi' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'Foto' => 'nullable|image',
            'password' => 'nullable|min:6|confirmed'
        ];

        $validated = $request->validate($rules);

        // Jika ada password baru
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        // Jika ada foto baru
        if ($request->hasFile('Foto')) {
            // Hapus foto lama jika ada
            if ($alumni->Foto && file_exists(storage_path('app/public/' . $alumni->Foto))) {
                unlink(storage_path('app/public/' . $alumni->Foto));
            }
            $validated['Foto'] = $request->file('Foto')->store('alumni', 'public');
        }

        // Update alumni record
        $alumni->update($validated);

        // Update associated user account
        if ($user = User::where('alumni_id', $alumni->id)->first()) {
            $userData = [
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'nim' => $validated['nim']
            ];

            if (isset($validated['password'])) {
                $userData['password'] = $validated['password'];
            }

            $user->update($userData);
        }

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alumni = \App\Models\alumni::findOrFail($id);

        // Delete associated user account
        if ($user = User::where('alumni_id', $alumni->id)->first()) {
            $user->delete();
        }

        // Delete photo if exists
        if ($alumni->Foto && file_exists(storage_path('app/public/' . $alumni->Foto))) {
            unlink(storage_path('app/public/' . $alumni->Foto));
        }

        $alumni->delete();
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil dihapus!');
    }

    /**
     * Export all alumni to Excel
     */
    public function exportAll()
    {
        return Excel::download(new AlumniExport, 'semua_alumni_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    /**
     * Export single alumni to Excel
     */
    public function exportSingle($id)
    {
        $alumni = \App\Models\alumni::findOrFail($id);
        return Excel::download(new SingleAlumniExport($id), 'alumni_' . $alumni->nama . '_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
