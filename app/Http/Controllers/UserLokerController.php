<?php

namespace App\Http\Controllers;

use App\Models\user_loker;
use App\Models\Loker; 
use Illuminate\Http\Request; 
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

    /**
     * PROSES MELAMAR & UPDATE STATUS (BUG FIXED)
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $lokerId = $request->loker_id;
        $status = $request->status ?? 'terkirim'; 

        // Cari apakah lamaran sudah ada
        $lamaran = user_loker::where('user_id', $userId)
                             ->where('loker_id', $lokerId)
                             ->first();

        // Jika BELUM PERNAH melamar -> Buat Baru
        if (!$lamaran) {
            user_loker::create([
                'user_id' => $userId,
                'loker_id' => $lokerId,
                'status' => $status 
            ]);
            
            return response()->json([
                'status' => 'success', 
                'message' => 'Lamaran berhasil dicatat di sistem.'
            ]);
        }

        // Jika SUDAH PERNAH melamar DAN ada request perubahan status (Dari fitur Lamaran Saya) -> UPDATE
        if ($request->has('status')) {
            $lamaran->update(['status' => $status]);
            return response()->json([
                'status' => 'success', 
                'message' => 'Status berhasil diperbarui.'
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

    public function bookmarks()
    {
        return view('user.bookmark_index'); 
    }

    public function rekomendasi()
    {
        $lokers = Loker::latest()->get(); 
        return view('user.rekomendasi', compact('lokers'));
    }
}