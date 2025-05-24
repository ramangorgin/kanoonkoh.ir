<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Program;
use App\Models\Course;
use App\Models\Report;
use App\Models\Ticket;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('dashboard.index', [
            'programs' => Program::whereHas('users', fn($q) => $q->where('user_id', $user->id))->get(),
            'courses' => Course::whereHas('users', fn($q) => $q->where('user_id', $user->id))->get(),
            'reports' => $user->reports ?? [],
            'tickets' => $user->tickets ?? [],
        ]);
    }
}
