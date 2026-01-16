<?php

namespace App\Http\Controllers;

use App\Models\loker;
use Illuminate\Http\Request;

class LokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['lokers'] = \App\Models\loker::latest()->paginate(10);
        return view('admin.loker_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.loker_create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        loker::create($validated);

        return redirect()->route('admin.loker.index')
            ->with('success', 'Lowongan kerja berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(loker $loker)
    {
        return view('admin.loker_show', compact('loker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(loker $loker)
    {
        return view('admin.loker_edit', compact('loker'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loker $loker)
    {
        $loker->delete();

        return redirect()->route('admin.loker.index')
            ->with('success', 'Lowongan kerja berhasil dihapus!');
    }
}
