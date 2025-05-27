<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('dashboard.index', [
            'user' => $user,
            'needsCompletion' => !$user->isProfileComplete(),
            'programs' => $user->programs()->latest()->get(),
            'courses' => $user->courses()->latest()->get(),
            'reports' => $user->reports()->latest()->get(),
            'tickets' => $user->tickets()->latest()->get(),
        ]);
    }
}
