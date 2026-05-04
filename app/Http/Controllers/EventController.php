<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreeventRequest;
use App\Http\Requests\UpdateeventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.event_index', [
            'events' => Event::latest()->paginate(10)
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event_create');
    }

    /**
     * Store a newly created resource in storage (Oleh Admin).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'deskripsi' => 'required',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'approved'; 

        Event::create($validated);
        
        return redirect()->route('admin.event.index')->with('success', 'Event berhasil ditambahkan!');
    }

    /**
     * APPROVE EVENT DARI ALUMNI
     */
    public function approve($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => 'approved']);

        return back()->with('success', 'Event disetujui dan dipublikasikan.');
    }

    /**
     * REJECT EVENT DARI ALUMNI
     */
    public function reject($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => 'rejected']);

        return back()->with('success', 'Event telah ditolak.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('admin.event_show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.event_edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'deskripsi' => 'required',
        ]);
        
        $event->update($validated);
        
        return redirect()->route('admin.event.index')->with('success', 'Event berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus!');
    }
}