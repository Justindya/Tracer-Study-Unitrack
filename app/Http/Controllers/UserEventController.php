<?php

namespace App\Http\Controllers;

use App\Models\user_event;
use Illuminate\Http\Request; 
use App\Http\Requests\Storeuser_eventRequest;
use App\Http\Requests\Updateuser_eventRequest;

class UserEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mulai query
        $query = \App\Models\Event::latest();

    
        if ($request->has('kategori')) {
            $kategori = $request->kategori;
            if ($kategori != 'Semua Event') {
                $query->where('judul', 'like', '%' . $kategori . '%');
            }
        }

        $events = $query->paginate(10);
        
        return view('user.event_index', compact('events'));
    }

   
    public function create()
    {
        //
    }

    public function store(Storeuser_eventRequest $request)
    {
        //
    }

    public function show($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        return view('user.event_show', compact('event'));
    }

    public function edit(user_event $user_event)
    {
        //
    }

    public function update(Updateuser_eventRequest $request, user_event $user_event)
    {
        //
    }

    public function destroy(user_event $user_event)
    {
        //
    }
}