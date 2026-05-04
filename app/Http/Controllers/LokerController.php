<?php

namespace App\Http\Controllers;

use App\Models\loker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokerController extends Controller
{
    public function index()
    {
        $lokers = loker::latest()->paginate(10);
        return view('admin.loker_index', compact('lokers'));
    }

    public function create()
    {
        return view('admin.loker_create');
    }

    public function store(Request $request)
    {
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
        $validated['status'] = 'approved'; 

        loker::create($validated);

        return redirect()->route('admin.loker.index')
            ->with('success', 'Lowongan kerja berhasil ditambahkan!');
    }

    /**
     * APPROVE LOKER DARI ALUMNI
     */
    public function approve($id)
    {
        $loker = loker::findOrFail($id);
        $loker->update(['status' => 'approved']);

        return back()->with('success', 'Lowongan kerja disetujui dan dipublikasikan.');
    }

    /**
     * REJECT LOKER DARI ALUMNI
     */
    public function reject($id)
    {
        $loker = loker::findOrFail($id);
        $loker->update(['status' => 'rejected']);

        return back()->with('success', 'Lowongan kerja telah ditolak.');
    }

    public function show(loker $loker)
    {
        return view('admin.loker_show', compact('loker'));
    }

    public function edit(loker $loker)
    {
        return view('admin.loker_edit', compact('loker'));
    }

    public function update(Request $request, loker $loker)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'perusahaan' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'kontak' => 'required|string',
        ]);

        $loker->update($validated);
        return redirect()->route('admin.loker.index')
            ->with('success', 'Lowongan kerja berhasil diperbarui!');
    }

    public function destroy(loker $loker)
    {
        $loker->delete();
        return redirect()->route('admin.loker.index')
            ->with('success', 'Lowongan kerja berhasil dihapus!');
    }
}