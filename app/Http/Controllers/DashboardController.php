<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alumni; // Pastikan nama model sesuai (huruf kecil/besar)
use App\Models\loker;
use App\Models\tracer;
use App\Models\user_loker; // Model untuk lamaran user
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * DASHBOARD ADMIN
     * Menghitung statistik lengkap untuk grafik dan kartu
     */
    public function index()
    {
        // 1. Hitung Total Data Utama
        $totalAlumni = alumni::count();
        $totalTracer = tracer::count();

        // 2. Hitung Statistik Gender (Total Alumni)
        $totalMale = alumni::where('jenis_kelamin', 'laki-laki')->count();
        $totalFemale = alumni::where('jenis_kelamin', 'perempuan')->count();

        // 3. Hitung Statistik Tracer berdasarkan Gender (Relasi ke Alumni)
        $tracerMale = tracer::whereHas('alumni', function($query) {
            $query->where('jenis_kelamin', 'laki-laki');
        })->count();

        $tracerFemale = tracer::whereHas('alumni', function($query) {
            $query->where('jenis_kelamin', 'perempuan');
        })->count();

        // Kirim SEMUA variabel ini ke View Admin
        return view('admin.dashboard', compact(
            'totalAlumni', 
            'totalTracer', 
            'totalMale', 
            'totalFemale', 
            'tracerMale', 
            'tracerFemale'
        ));
    }

    /**
     * DASHBOARD USER (Mahasiswa/Alumni)
     * Menghitung lamaran pribadi dan aktivitas
     */
    public function userIndex()
    {
        $userId = Auth::id();

        // 1. Ambil Statistik Lamaran (Realtime DB)
        // Menggunakan user_loker (tabel user_lokers)
        $lamaranCount = user_loker::where('user_id', $userId)->count();
        $diterimaCount = user_loker::where('user_id', $userId)->where('status', 'diterima')->count();
        $diprosesCount = user_loker::where('user_id', $userId)->where('status', 'diproses')->count();
        
        // 2. Ambil Aktivitas Terbaru (3 Lamaran Terakhir)
        // with('loker') agar bisa menampilkan judul pekerjaan
        $activities = user_loker::with('loker') 
                        ->where('user_id', $userId)
                        ->latest()
                        ->limit(3)
                        ->get();

        // 3. Lowongan untuk rekomendasi (jika diperlukan di dashboard)
        $lowongans = loker::latest()->limit(5)->get();

        return view('dashboard', compact(
            'lamaranCount', 
            'diterimaCount', 
            'diprosesCount', 
            'activities',
            'lowongans'
        ));
    }
}