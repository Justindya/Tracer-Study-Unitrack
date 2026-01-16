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
    public function index()
    {
        return view('admin.event_index', [
            'events' => event::latest()->paginate(10)
        ]); // folder admin, file event_index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'deskripsi' => 'required',
        ]);

        event::create($validated);
        return redirect()->route('admin.event.index')->with('success', 'Event berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(event $event)
    {
        return view('admin.event_show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(event $event)
    {
        return view('admin.event_edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, event $event)
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
    public function destroy(event $event)
    {
        $event->delete();
        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus!');
    }
}
