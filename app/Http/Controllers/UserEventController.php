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
        $query = Event::where('status', 'approved')->latest();

        if ($request->has('kategori')) {
            $kategori = $request->kategori;
            if ($kategori != 'Semua Event') {
                $query->where('judul', 'like', '%' . $kategori . '%');
            }
        }

        $events = $query->paginate(10);
        
        return view('user.event_index', compact('events'));
    }

    /**
     * TAMPILKAN FORM UNGGAH EVENT KHUSUS ALUMNI
     */
    public function createEvent()
    {
        if (Auth::user()->role !== 'alumni') {
            abort(403, 'Hanya Alumni yang dapat membuat Event.');
        }
        return view('user.event_create');
    }

    /**
     * SIMPAN EVENT DARI ALUMNI (STATUS PENDING)
     */
    public function storeEvent(Request $request)
    {
        if (Auth::user()->role !== 'alumni') {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'deskripsi' => 'required',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Event::create($validated);

        return redirect()->route('user.events.index')
            ->with('success', 'Event berhasil diajukan dan menunggu persetujuan Admin.');
    }

    /**
     * PROSES PENDAFTARAN/JOIN EVENT OLEH USER
     */
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
    
    /**
     * MEMBATALKAN PENDAFTARAN EVENT
     */
    public function destroy($id) 
    {
        $userId = Auth::id();
        
        $registration = user_event::where('user_id', $userId)
                                  ->where('event_id', $id)
                                  ->first();

        if ($registration) {
            $registration->delete(); 
            return redirect()->back()->with('success', 'Berhasil membatalkan pendaftaran event.');
        }

        return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
    }
}