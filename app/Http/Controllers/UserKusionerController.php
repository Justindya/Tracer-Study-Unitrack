<?php

namespace App\Http\Controllers;

use App\Models\kusioner;
use App\Models\user_kusioner;
use App\Models\KusionerJawaban;
use Illuminate\Http\Request;
use App\Http\Requests\Updateuser_kusionerRequest;

class UserKusionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // di controller UserKusionerController.php
    public function index()
    {
        $kusioners = Kusioner::all();
        return view('user.kusioner_index', compact('kusioners'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.kusioner_jawab', [
            'kusioners' => kusioner::all(),
            // 'userKusioner' => user_kusioner::where('user_id', auth()->id())->first(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|string',
        ]);

        // Simpan jawaban untuk setiap kuisioner
        foreach ($data['jawaban'] as $kusioner_id => $jawaban) {
            user_kusioner::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'kusioner_id' => $kusioner_id,
                ]
            );
            KusionerJawaban::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'kusioner_id' => $kusioner_id,
                ],
                [
                    'jawaban' => $jawaban,
                ]
            );
        }

        return redirect()->route('user.kusioner.index')->with('success', 'Jawaban berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(user_kusioner $user_kusioner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_kusioner $user_kusioner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateuser_kusionerRequest $request, user_kusioner $user_kusioner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_kusioner $user_kusioner)
    {
        //
    }
}
