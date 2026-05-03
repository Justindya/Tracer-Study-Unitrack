<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Http\Requests\StoreeventRequest;
use App\Http\Requests\UpdateeventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $status = $request->get('status', 'all');
        $query = event::latest();
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $events = $query->paginate(10);
        return view('admin.event_index', compact('events', 'status'));
    }

    public function create()
    {
        return view('admin.event_create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'tema' => 'nullable|string',
            'tempat' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'deskripsi' => 'required|string',
            'is_paid' => 'required|boolean',
            'harga' => 'required_if:is_paid,1|numeric|min:0',
            'pembicara' => 'nullable|string',
            'poster' => 'nullable|image|max:2048',
        ]);

        $validated['status'] = 'approved';

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('events/posters', 'public');
        }

        event::create($validated);
        return redirect()->route('admin.event.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function show(event $event)
    {
        return view('admin.event_show', compact('event'));
    }

    public function edit(event $event)
    {
        return view('admin.event_edit', compact('event'));
    }

    public function update(\Illuminate\Http\Request $request, event $event)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'tema' => 'nullable|string',
            'tempat' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'deskripsi' => 'required|string',
            'is_paid' => 'required|boolean',
            'harga' => 'required_if:is_paid,1|numeric|min:0',
            'pembicara' => 'nullable|string',
            'poster' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            if ($event->poster && \Illuminate\Support\Facades\Storage::disk('public')->exists($event->poster)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($event->poster);
            }
            $validated['poster'] = $request->file('poster')->store('events/posters', 'public');
        }

        $event->update($validated);
        return redirect()->route('admin.event.index')->with('success', 'Event berhasil diupdate!');
    }

    public function approve($id)
    {
        $event = event::findOrFail($id);
        $event->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Event berhasil disetujui!');
    }

    public function reject($id)
    {
        $event = event::findOrFail($id);
        $event->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Event ditolak.');
    }

    public function destroy(event $event)
    {
        if ($event->poster && \Illuminate\Support\Facades\Storage::disk('public')->exists($event->poster)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($event->poster);
        }
        $event->delete();
        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus!');
    }
}
