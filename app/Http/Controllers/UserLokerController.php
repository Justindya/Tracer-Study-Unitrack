<?php

namespace App\Http\Controllers;

use App\Models\user_loker;
use App\Models\Loker; 
use Illuminate\Http\Request; // Pakai Request standar biar simpel
use Illuminate\Support\Facades\Auth;

class UserLokerController extends Controller
{
    public function index(Request $request)
    {
        $query = Loker::latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('perusahaan', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($request->has('tipe') && $request->tipe != '') {
            $tipe = $request->tipe;
            $query->where(function($q) use ($tipe) {
                $q->where('judul', 'like', "%{$tipe}%")
                  ->orWhere('deskripsi', 'like', "%{$tipe}%");
            });
        }

        $lokers = $query->paginate(9);
        return view('user.loker_index', compact('lokers'));
    }

    public function create()
    {
        //
    }

    // LOGIKA PENYIMPANAN LAMARAN (AJAX)
    public function store(Request $request)
    {
        $userId = Auth::id();
        $lokerId = $request->loker_id;

        // Cek apakah user sudah pernah melamar di loker ini?
        $exists = user_loker::where('user_id', $userId)
                            ->where('loker_id', $lokerId)
                            ->exists();

        if (!$exists) {
            // Jika belum, simpan data baru
            user_loker::create([
                'user_id' => $userId,
                'loker_id' => $lokerId,
                'status' => 'terkirim' // Status default
            ]);
            
            return response()->json([
                'status' => 'success', 
                'message' => 'Lamaran berhasil dicatat di sistem.'
            ]);
        }

        return response()->json([
            'status' => 'info', 
            'message' => 'Anda sudah melamar pekerjaan ini sebelumnya.'
        ]);
    }

    public function show($id)
    {
        $loker = \App\Models\Loker::findOrFail($id);
        
        // Cek apakah user sudah melamar loker ini? (Untuk UI button)
        $hasApplied = false;
        if(Auth::check()){
            $hasApplied = user_loker::where('user_id', Auth::id())
                                    ->where('loker_id', $id)
                                    ->exists();
        }

        return view('user.loker_show', compact('loker', 'hasApplied'));
    }

    public function rekomendasi()
    {
        $lokers = Loker::latest()->get(); 
        return view('user.rekomendasi', compact('lokers'));
    }
}