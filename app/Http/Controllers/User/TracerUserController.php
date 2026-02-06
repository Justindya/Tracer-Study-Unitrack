<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\tracer;
use App\Models\bekerja;
use App\Models\wiraswasta;
use App\Models\melanjutkan_pendidikan;
use App\Models\tidak_bekerja;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TracerUserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $alumniId = Auth::user()->alumni->id ?? null;

        if (!$alumniId) {
            return redirect()->route('user.alumni.index')->with('error', 'Data alumni tidak ditemukan. Silakan lengkapi biodata.');
        }

        $tracers = tracer::where('alumni_id', $alumniId)->orderBy('created_at', 'desc')->get();
        return view('user.tracer.index', compact('tracers'));
    }

    public function create()
    {
        $alumniId = Auth::user()->alumni->id ?? null;

        if (!$alumniId) {
            return redirect()->route('user.alumni.index')->with('error', 'Data alumni tidak ditemukan. Silakan lengkapi biodata.');
        }

        return view('user.tracer.create');
    }

    public function store(Request $request)
    {
        $alumniId = Auth::user()->alumni->id ?? null;
        if (!$alumniId) {
            return redirect()->route('user.alumni.index')->with('error', 'Data alumni tidak ditemukan.');
        }

        $rules = [
            'status' => 'required|in:bekerja,wiraswasta,melanjutkan_pendidikan,tidak_bekerja',
            'tanggal_mulai' => 'required|date',
        ];

        if (in_array($request->status, ['bekerja', 'wiraswasta', 'melanjutkan_pendidikan'])) {
            $rules['soal_1'] = 'required'; 
            $rules['soal_2'] = 'required';
        }

        $validated = $request->validate($rules);
        $validated['alumni_id'] = $alumniId;

        tracer::create([
            'alumni_id' => $alumniId,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
        ]);

        $this->storeStatusData($request, $alumniId);

        return redirect()->route('user.tracer.index')->with('success', 'Data tracer berhasil disimpan! Terima kasih atas partisipasi Anda.');
    }

    public function update(Request $request, tracer $tracer)
    {
        $this->authorize('update', $tracer);
        
        $rules = [
            'status' => 'required|in:bekerja,wiraswasta,melanjutkan_pendidikan,tidak_bekerja',
            'tanggal_mulai' => 'required|date',
        ];

        if (in_array($request->status, ['bekerja', 'wiraswasta', 'melanjutkan_pendidikan'])) {
            $rules['soal_1'] = 'required';
            $rules['soal_2'] = 'required';
        }

        $request->validate($rules);

        $tracer->update([
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
        ]);

        $this->storeStatusData($request, $tracer->alumni_id, true);

        return redirect()->route('user.tracer.index')->with('success', 'Data tracer berhasil diperbarui.');
    }

    private function storeStatusData($request, $alumniId, $isUpdate = false)
    {
        $status = $request->input('status');
        if ($status === 'bekerja') {
            $data = $request->only(['soal_1', 'soal_2', 'soal_3', 'soal_4', 'soal_5', 'soal_6', 'soal_7', 'soal_8']);
            $data['alumni_id'] = $alumniId;
            \App\Models\bekerja::updateOrCreate(['alumni_id' => $alumniId], $data);
            
        } elseif ($status === 'wiraswasta') {
            $data = $request->only(['soal_1', 'soal_2', 'soal_3', 'soal_4', 'soal_5']);
            $data['alumni_id'] = $alumniId;
            \App\Models\wiraswasta::updateOrCreate(['alumni_id' => $alumniId], $data);

        } elseif ($status === 'melanjutkan_pendidikan') {
            $data = $request->only(['soal_1', 'soal_2', 'soal_3', 'soal_4', 'soal_5']);
            $data['alumni_id'] = $alumniId;
            \App\Models\melanjutkan_pendidikan::updateOrCreate(['alumni_id' => $alumniId], $data);

        } elseif ($status === 'tidak_bekerja') {
            $data = $request->only(['soal_1', 'soal_2', 'soal_3']);
            $data['alumni_id'] = $alumniId;
            \App\Models\tidak_bekerja::updateOrCreate(['alumni_id' => $alumniId], $data);
        }
    }

    public function show(tracer $tracer) { return view('user.tracer.show', compact('tracer')); }
    public function edit(tracer $tracer) { return view('user.tracer.edit', compact('tracer')); }
    public function destroy(tracer $tracer) { $tracer->delete(); return redirect()->back(); }
}