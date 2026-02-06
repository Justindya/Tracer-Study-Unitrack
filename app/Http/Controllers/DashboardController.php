<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alumni; 
use App\Models\loker;
use App\Models\tracer;
use App\Models\user_loker;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlumni = alumni::count();
        $totalTracer = tracer::count();

        $totalMale = alumni::where('jenis_kelamin', 'laki-laki')->count();
        $totalFemale = alumni::where('jenis_kelamin', 'perempuan')->count();

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

    public function userIndex()
    {
        $userId = Auth::id(); 
        $user = Auth::user();
        $alumni = $user->alumni; 

        $lamaranCount = user_loker::where('user_id', $userId)->count();
        $diterimaCount = user_loker::where('user_id', $userId)->where('status', 'diterima')->count();
        $diprosesCount = user_loker::where('user_id', $userId)->where('status', 'diproses')->count();
        
        $activities = user_loker::with('loker') 
                        ->where('user_id', $userId) 
                        ->latest()
                        ->limit(3)
                        ->get();

        $lowongans = loker::latest()->limit(5)->get();

        $progress = 30; 
        
        $bioComplete = false;
        $tracerComplete = false;

        // Cek Biodata (Bio, Foto, Skill)
        if ($alumni && $alumni->bio && $alumni->Foto && $alumni->skill) {
            $progress += 35;
            $bioComplete = true;
        } elseif ($alumni) {
            $progress += 15; 
        }
        if ($alumni) {
            $hasTracer = $alumni->tracers()->exists();
            
            if ($hasTracer) {
                $progress += 35;
                $tracerComplete = true;
            }
        }

        return view('dashboard', compact(
            'lamaranCount', 
            'diterimaCount', 
            'diprosesCount', 
            'activities',
            'lowongans',
            'progress',      
            'bioComplete',   
            'tracerComplete' 
        ));
    }
}