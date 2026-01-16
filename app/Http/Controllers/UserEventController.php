<?php

namespace App\Http\Controllers;

use App\Models\user_event;
use App\Http\Requests\Storeuser_eventRequest;
use App\Http\Requests\Updateuser_eventRequest;

class UserEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = \App\Models\Event::latest()->paginate(10);
        return view('user.event_index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeuser_eventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        return view('user.event_show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_event $user_event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateuser_eventRequest $request, user_event $user_event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_event $user_event)
    {
        //
    }
}
