<?php

namespace App\Http\Controllers;

use App\Models\user_loker;
use App\Models\Loker; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class UserLokerController extends Controller
{
    /**
     * MENAMPILKAN DAFTAR LOWONGAN (LOKER)
     */
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

    /**
     * PROSES MELAMAR PEKERJAAN
     * Disimpan ke tabel 'user_lokers'
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $lokerId = $request->loker_id;
        $exists = user_loker::where('user_id', $userId)
                            ->where('loker_id', $lokerId)
                            ->exists();

        if (!$exists) {
            user_loker::create([
                'user_id' => $userId,
                'loker_id' => $lokerId,
                'status' => 'terkirim' 
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

    /**
     * HALAMAN DETAIL LOKER
     */
    public function show($id)
    {
        $loker = \App\Models\Loker::findOrFail($id);
        $hasApplied = false;
        if(Auth::check()){
            $hasApplied = user_loker::where('user_id', Auth::id())
                                    ->where('loker_id', $id)
                                    ->exists();
        }

        return view('user.loker_show', compact('loker', 'hasApplied'));
    }

    public function historyLamaran()
    {
        $userId = Auth::id();
        $lamarans = user_loker::with('loker') 
                        ->where('user_id', $userId)
                        ->latest()
                        ->get();

        return view('user.lamaran_index', compact('lamarans'));
    }

    /**
     * HALAMAN BOOKMARK
     */
    public function bookmarks()
    {
        return view('user.bookmark_index'); 
    }

    /**
     * HALAMAN REKOMENDASI LOKER
     */
    public function rekomendasi()
    {
        $lokers = Loker::latest()->get(); 
        return view('user.rekomendasi', compact('lokers'));
    }
}