<?php

namespace App\Http\Controllers;

use App\Models\loker;
use Illuminate\Http\Request;

class LokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $query = Loker::latest();
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis_perusahaan', $request->jenis);
        }

        $lokers = $query->paginate(10);
        return view('admin.loker_index', compact('lokers', 'status'));
    }

    public function create()
    {
        return view('admin.loker_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'posisi' => 'required|string',
            'perusahaan' => 'required|string',
            'jenis_perusahaan' => 'required|string',
            'email_perusahaan' => 'required|email',
            'jumlah_dibutuhkan' => 'required|integer',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'kontak' => 'required|string',
            'poster' => 'nullable|image|max:2048',
        ]);

        $validated['status'] = 'approved'; // Admin creation is auto-approved

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('lokers/posters', 'public');
        }

        Loker::create($validated);

        return redirect()->route('admin.loker.index')
            ->with('success', 'Lowongan kerja berhasil ditambahkan!');
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
            'posisi' => 'required|string',
            'perusahaan' => 'required|string',
            'jenis_perusahaan' => 'required|string',
            'email_perusahaan' => 'required|email',
            'jumlah_dibutuhkan' => 'required|integer',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'kontak' => 'required|string',
            'poster' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            // Delete old poster
            if ($loker->poster && \Illuminate\Support\Facades\Storage::disk('public')->exists($loker->poster)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($loker->poster);
            }
            $validated['poster'] = $request->file('poster')->store('lokers/posters', 'public');
        }

        $loker->update($validated);
        return redirect()->route('admin.loker.index')
            ->with('success', 'Lowongan kerja berhasil diperbarui!');
    }

    public function approve($id)
    {
        $loker = Loker::findOrFail($id);
        $loker->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Lowongan kerja berhasil disetujui!');
    }

    public function reject($id)
    {
        $loker = Loker::findOrFail($id);
        $loker->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Lowongan kerja ditolak.');
    }

    public function destroy(loker $loker)
    {
        if ($loker->poster && \Illuminate\Support\Facades\Storage::disk('public')->exists($loker->poster)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($loker->poster);
        }
        $loker->delete();

        return redirect()->route('admin.loker.index')
            ->with('success', 'Lowongan kerja berhasil dihapus!');
    }
}
