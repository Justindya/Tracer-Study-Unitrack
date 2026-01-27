<?php

namespace App\Http\Controllers;

use App\Models\user_alumni;
use App\Models\alumni; 
use App\Http\Requests\Storeuser_alumniRequest;
use App\Http\Requests\Updateuser_alumniRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserAlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = alumni::query();
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('program_studi', 'like', "%{$search}%")
                  ->orWhere('angkatan', 'like', "%{$search}%");
            });
        }
        if ($request->has('jurusan')) {
            $query->where('program_studi', 'like', "%{$request->jurusan}%");
        }
        $alumni = $query->latest()->paginate(9);
        return view('user.alumni_index', compact('alumni'));
    }

    public function create()
    {
    }

    public function store(Storeuser_alumniRequest $request)
    {
    }

    public function show(string $id)
    {
        $alumni = alumni::findOrFail($id);
        return view('user.alumni_show', compact('alumni'));
    }

    public function edit(string $id)
    {
        $user = Auth::user();
        $alumni = alumni::where('nim', $user->nim)->firstOrFail();

        if ($alumni->id != $id) {
            abort(403, 'Unauthorized action.');
        }
        return view('user.alumni_edit', compact('alumni'));
    }

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
            'bio' => 'nullable|string|max:500', 
            'linkedin' => 'nullable|url|max:255',
            'Foto' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:500', 
            'linkedin' => 'nullable|url|max:255',
            'skill' => 'nullable|string|max:500', 
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
        return redirect()->route('user.alumni.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy(user_alumni $user_alumni)
    {
        //
    }
}