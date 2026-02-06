<?php

namespace App\Http\Controllers;

use App\Models\user_event;
use App\Models\Event;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class UserEventController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Event::latest();

        if ($request->has('kategori')) {
            $kategori = $request->kategori;
            if ($kategori != 'Semua Event') {
                $query->where('judul', 'like', '%' . $kategori . '%');
            }
        }

        $events = $query->paginate(10);
        
        return view('user.event_index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $userId = Auth::id();
        $eventId = $request->event_id;

        $exists = user_event::where('user_id', $userId)
                            ->where('event_id', $eventId)
                            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di event ini!');
        }
        user_event::create([
            'user_id' => $userId,
            'event_id' => $eventId
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar event! Silakan cek jadwal.');
    }

    public function show($id)
    {
        $event = Event::with('participants')->findOrFail($id);
        
        $isRegistered = false;
        if (Auth::check()) {
            $isRegistered = $event->participants->contains(Auth::user()->id);
        }

        return view('user.event_show', compact('event', 'isRegistered'));
    }

    public function create() {}
    public function edit(user_event $user_event) {}
    public function update(Request $request, user_event $user_event) {}
    public function destroy(user_event $user_event) {}
}