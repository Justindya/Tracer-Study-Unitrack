<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\tracer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TracerUserController extends Controller
{
    use AuthorizesRequests;

    // Tampilkan semua data tracer milik alumni yang sedang login
    public function index()
    {
        $alumniId = Auth::user()->alumni->id ?? null;

        if (!$alumniId) {
            return redirect()->route('user.alumni.index')->with('error', 'Data alumni tidak ditemukan.');
        }

        $tracers = tracer::where('alumni_id', $alumniId)->orderBy('created_at', 'desc')->get();
        return view('user.tracer.index', compact('tracers'));
    }

    // Tampilkan form tambah tracer
    public function create()
    {
        $alumniId = Auth::user()->alumni->id ?? null;

        if (!$alumniId) {
            return redirect()->route('user.alumni.index')->with('error', 'Data alumni tidak ditemukan.');
        }

        return view('user.tracer.create');
    }

    // Simpan data tracer baru
    public function store(Request $request)
    {
        $alumniId = Auth::user()->alumni->id ?? null;
        if (!$alumniId) {
            return redirect()->route('user.alumni.index')->with('error', 'Data alumni tidak ditemukan.');
        }
        $validated = $request->validate([
            'status' => 'required|in:bekerja,wiraswasta,melanjutkan_pendidikan,tidak_bekerja',
            'tanggal_mulai' => 'required|date',
            'soal_1' => 'required',
            'soal_2' => 'required',
            'soal_3' => 'required',
        ]);
        $validated['alumni_id'] = $alumniId;
        tracer::create($validated);
        $this->storeStatusData($request, $alumniId);
        return redirect()->route('user.tracer.index')->with('success', 'Data tracer berhasil ditambahkan.');
    }

    // Tampilkan detail tracer
    public function show(tracer $tracer)
    {
        $this->authorize('view', $tracer);
        return view('user.tracer.show', compact('tracer'));
    }

    // Tampilkan form edit tracer
    public function edit(tracer $tracer)
    {
        $this->authorize('update', $tracer);
        return view('user.tracer.edit', compact('tracer'));
    }

    // Update data tracer
    public function update(Request $request, tracer $tracer)
    {
        $this->authorize('update', $tracer);
        $validated = $request->validate([
            'status' => 'required|in:bekerja,wiraswasta,melanjutkan_pendidikan,tidak_bekerja',
            'tanggal_mulai' => 'required|date',
            'soal_1' => 'required',
            'soal_2' => 'required',
            'soal_3' => 'required',
        ]);
        $tracer->update($validated);
        $this->storeStatusData($request, $tracer->alumni_id, true);
        return redirect()->route('user.tracer.index')->with('success', 'Data tracer berhasil diupdate.');
    }

    // Hapus data tracer
    public function destroy(tracer $tracer)
    {
        $this->authorize('delete', $tracer);
        $tracer->delete();

        return redirect()->route('user.tracer.index')->with('success', 'Data tracer berhasil dihapus.');
    }

    private function storeStatusData($request, $alumniId, $isUpdate = false)
    {
        $status = $request->input('status');
        if ($status === 'bekerja') {
            $data = $request->only(['soal_1', 'soal_2', 'soal_3', 'soal_4', 'soal_5', 'soal_6', 'soal_7', 'soal_8']);
            $data['alumni_id'] = $alumniId;
            if ($isUpdate) \App\Models\bekerja::updateOrCreate(['alumni_id' => $alumniId], $data);
            else \App\Models\bekerja::create($data);
        } elseif ($status === 'wiraswasta') {
            $data = $request->only(['soal_1', 'soal_2', 'soal_3', 'soal_4', 'soal_5']);
            $data['alumni_id'] = $alumniId;
            if ($isUpdate) \App\Models\wiraswasta::updateOrCreate(['alumni_id' => $alumniId], $data);
            else \App\Models\wiraswasta::create($data);
        } elseif ($status === 'melanjutkan_pendidikan') {
            $data = $request->only(['soal_1', 'soal_2', 'soal_3', 'soal_4', 'soal_5']);
            $data['alumni_id'] = $alumniId;
            if ($isUpdate) \App\Models\melanjutkan_pendidikan::updateOrCreate(['alumni_id' => $alumniId], $data);
            else \App\Models\melanjutkan_pendidikan::create($data);
        } elseif ($status === 'tidak_bekerja') {
            $data = $request->only(['soal_1', 'soal_2', 'soal_3']);
            $data['alumni_id'] = $alumniId;
            if ($isUpdate) \App\Models\tidak_bekerja::updateOrCreate(['alumni_id' => $alumniId], $data);
            else \App\Models\tidak_bekerja::create($data);
        }
    }
}
