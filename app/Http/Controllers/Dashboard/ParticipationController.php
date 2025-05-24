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
        $user = Auth::user();

        $programs = $user->programs()->with('pivot')->latest()->get();
        $courses = $user->courses()->with('pivot')->latest()->get();

        return view('dashboard.participation.index', compact('programs', 'courses'));
    }
}
