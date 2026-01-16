<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alumni;
use App\Models\event;
use App\Models\loker;
use App\Models\kusioner;
use App\Models\tracer;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk grafik tracer berdasarkan gender
        $totalAlumni = alumni::count();
        $totalTracer = tracer::count();

        // Hitung total alumni berdasarkan gender
        $totalMale = alumni::where('jenis_kelamin', 'laki-laki')->count();
        $totalFemale = alumni::where('jenis_kelamin', 'perempuan')->count();

        // Hitung alumni dengan tracer berdasarkan gender
        $tracerMale = tracer::whereHas('alumni', function($query) {
            $query->where('jenis_kelamin', 'laki-laki');
        })->count();

        $tracerFemale = tracer::whereHas('alumni', function($query) {
            $query->where('jenis_kelamin', 'perempuan');
        })->count();

        return view('admin.dashboard', compact(
            'totalAlumni',
            'totalTracer',
            'totalMale',
            'totalFemale',
            'tracerMale',
            'tracerFemale'
        ));
    }
}
