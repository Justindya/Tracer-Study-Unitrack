<?php

namespace App\Http\Controllers;

use App\Models\kusioner;
use App\Http\Requests\StorekusionerRequest;
use App\Http\Requests\UpdatekusionerRequest;

class KusionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kusioners'] = kusioner::latest()->paginate(10);
        return view('admin.kusioner_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kusioner_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {

        $validated = $request->validate([
            'soal' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
        ]);

        kusioner::create($validated);

        return redirect()->route('admin.kusioner.index')
            ->with('success', 'kusioner berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(kusioner $kusioner)
    {
        $jawabans = $kusioner->jawabans()->with('user')->get();
        return view('admin.kusioner_show', compact('kusioner', 'jawabans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kusioner $kusioner)
    {
        return view('admin.kusioner_edit', compact('kusioner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, kusioner $kusioner)
    {
        $validated = $request->validate([
            'soal' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
        ]);

        $kusioner->update($validated);

        return redirect()->route('admin.kusioner.index')
            ->with('success', 'kusioner berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kusioner $kusioner)
    {
        $kusioner->delete();

        return redirect()->route('admin.kusioner.index')
            ->with('success', 'kusioner berhasil dihapus!');
    }

    
}
