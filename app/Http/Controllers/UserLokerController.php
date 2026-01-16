<?php

namespace App\Http\Controllers;

use App\Models\user_loker;
use App\Models\Loker; // Pastikan ini ada
use Illuminate\Http\Request; // Ubah ini biar fleksibel
use App\Http\Requests\Storeuser_lokerRequest;
use App\Http\Requests\Updateuser_lokerRequest;

class UserLokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // Tambahkan Request $request
    {
        // LOGIKA PENCARIAN (New Feature)
        $query = Loker::latest();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('perusahaan', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
        }

        $lokers = $query->paginate(10);
        
        return view('user.loker_index', compact('lokers'));
    }

    // ... (SISA FUNGSI create, store, dll BIARKAN TETAP SAMA SEPERTI ASLINYA) ...
    // Copy-paste sisa fungsi dari file aslimu di bawah ini agar aman.
    
    public function create()
    {
        //
    }

    public function store(Storeuser_lokerRequest $request)
    {
        $id = $request->input('id'); 
        $loker = \App\Models\Loker::findOrFail($id);
        return view('user.loker_show', compact('lokers'));
    }

    public function show($id)
    {
        $loker = \App\Models\Loker::findOrFail($id);
        return view('user.loker_show', compact('loker'));
    }
}