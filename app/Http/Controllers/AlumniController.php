<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\alumni; 
use Illuminate\Support\Facades\Hash;
use App\Exports\AlumniExport;
use App\Exports\SingleAlumniExport;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{
    public function index()
    {
        $data['alumnis'] = \App\Models\alumni::with('user')->latest()->paginate(10);
        return view('admin.alumni_index', $data);
    }

    public function create()
    {
        return view('admin.alumni_register');
    }

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

        $alumni = \App\Models\alumni::create($validated);
        
        // Buat user langsung ACTIVE jika dibuat oleh Admin
        User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'nim' => $validated['nim'],
            'password' => $validated['password'],
            'role' => 'alumni',
            'status' => 'active', 
            'alumni_id' => $alumni->id
        ]);

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $data['alumni'] = \App\Models\alumni::with('user')->findOrFail($id);
        return view('admin.alumni_show', $data);
    }

    public function edit(string $id)
    {
        $data['alumni'] = \App\Models\alumni::findOrFail($id);
        return view('admin.alumni_edit', $data);
    }

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

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('Foto')) {
            if ($alumni->Foto && file_exists(storage_path('app/public/' . $alumni->Foto))) {
                unlink(storage_path('app/public/' . $alumni->Foto));
            }
            $validated['Foto'] = $request->file('Foto')->store('alumni', 'public');
        }

        $alumni->update($validated);

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

    public function destroy(string $id)
    {
        $alumni = \App\Models\alumni::findOrFail($id);
        if ($user = User::where('alumni_id', $alumni->id)->first()) {
            $user->delete();
        }
        if ($alumni->Foto && file_exists(storage_path('app/public/' . $alumni->Foto))) {
            unlink(storage_path('app/public/' . $alumni->Foto));
        }
        $alumni->delete();
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil dihapus!');
    }

    public function verify($id)
    {
        // Cari user yang terhubung dengan alumni ini
        $user = User::where('alumni_id', $id)->firstOrFail();
        
        // Update status menjadi active
        $user->update(['status' => 'active']);

        return redirect()->back()->with('success', 'Akun alumni berhasil diverifikasi/diaktifkan!');
    }

    public function exportAll()
    {
        return Excel::download(new AlumniExport, 'semua_alumni_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function exportSingle($id)
    {
        $alumni = \App\Models\alumni::findOrFail($id);
        return Excel::download(new SingleAlumniExport($id), 'alumni_' . $alumni->nama . '_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}