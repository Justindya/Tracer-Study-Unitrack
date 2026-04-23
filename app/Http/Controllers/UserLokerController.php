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
        $query = Loker::where('status', 'approved')->latest();
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
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis_perusahaan', $request->jenis);
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
        $user = Auth::user();
        $skills = [];
        
        if ($user->alumni && $user->alumni->skill) {
            // Bersihkan skill dari spasi dan pisahkan koma
            $skills = array_map('trim', explode(',', $user->alumni->skill));
            $skills = array_filter($skills); // Hilangkan yang kosong
        }

        $lokers = Loker::where('status', 'approved')->latest()->get(); 
        return view('user.rekomendasi', compact('lokers', 'skills'));
    }
    public function propose()
    {
        return view('user.loker_propose');
    }

    public function storePropose(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'jenis_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => 'required|email',
            'jumlah_dibutuhkan' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'kontak' => 'required|string',
            'poster' => 'nullable|image|max:2048',
        ]);

        $validated['status'] = 'pending';
        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('lokers/posters', 'public');
        }

        Loker::create($validated);

        return redirect()->route('user.lokers.index')->with('success', 'Usulan lowongan berhasil dikirim! Menunggu persetujuan admin.');
    }
}