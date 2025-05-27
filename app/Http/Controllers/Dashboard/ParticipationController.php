<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ProgramRegistration;
use App\Models\CourseRegistration;
use Illuminate\Support\Facades\Auth;

class ParticipationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        $programs = $user->programs; 
    
        return view('dashboard.participation.index', compact('programs'));
    }
    
}
