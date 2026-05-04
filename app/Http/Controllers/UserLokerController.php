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
        
        $lokers = $query->paginate(9);
        return view('user.loker_index', compact('lokers'));
    }

    /**
     * FORM UNTUK ALUMNI UNGGAH LOKER BARU
     */
    public function createLoker()
    {
        if (Auth::user()->role !== 'alumni') {
            abort(403, 'Hanya Alumni yang dapat mengunggah lowongan kerja.');
        }
        return view('user.loker_create');
    }

    /**
     * SSTATUS PENDING
     */
    public function storeLoker(Request $request)
    {
        if (Auth::user()->role !== 'alumni') {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string',
            'perusahaan' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'kontak' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending'; 

        Loker::create($validated);

        return redirect()->route('user.lokers.index')
            ->with('success', 'Lowongan berhasil dikirim dan menunggu persetujuan Admin.');
    }

    /**
     * PROSES MELAMAR 
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $lokerId = $request->loker_id;
        $status = $request->status ?? 'terkirim'; 

        $lamaran = user_loker::where('user_id', $userId)
                             ->where('loker_id', $lokerId)
                             ->first();

        if (!$lamaran) {
            user_loker::create([
                'user_id' => $userId,
                'loker_id' => $lokerId,
                'status' => $status 
            ]);
            
            return response()->json([
                'status' => 'success', 
                'message' => 'Lamaran berhasil dicatat.'
            ]);
        }

        if ($request->has('status')) {
            $lamaran->update(['status' => $status]);
            return response()->json([
                'status' => 'success', 
                'message' => 'Status berhasil diperbarui.'
            ]);
        }

        return response()->json([
            'status' => 'info', 
            'message' => 'Anda sudah melamar sebelumnya.'
        ]);
    }

    public function show($id)
    {
        $loker = Loker::findOrFail($id);
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
        $lokers = Loker::where('status', 'approved')->latest()->get(); 
        
        $user = \Illuminate\Support\Facades\Auth::user();
        $skills = [];
        
        if ($user && $user->alumni && $user->alumni->skill) {
            $skills = array_map('trim', explode(',', $user->alumni->skill)); 
        }

        return view('user.rekomendasi', compact('lokers', 'skills'));
    }
}