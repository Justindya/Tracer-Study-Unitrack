<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'angkatan' => ['required', 'string', 'max:255'],
            'program_studi' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:15'],
            'jenis_kelamin' => ['required', 'string', 'in:laki-laki,perempuan'],
            'alamat' => ['required', 'string', 'max:500'],
            'tahun_lulus' => ['nullable', 'string', 'max:255'], 
        ]);
        $tahunLulus = $request->tahun_lulus ?? '-';

        $alumni = \App\Models\Alumni::create([
            'nama' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'angkatan' => $request->angkatan,
            'program_studi' => $request->program_studi,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'tahun_lulus' => $tahunLulus, 
        ]);
        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', 
            'status' => 'pending', 
            'alumni_id' => $alumni->id,
        ]);

        event(new Registered($user));
        return redirect()->route('login')->with('status', 'Registrasi berhasil! Akun Anda sedang menunggu verifikasi Admin.');
    }
}