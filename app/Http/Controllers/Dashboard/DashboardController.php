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
            'needsCompletion' => !$user->profile || !$user->profile->first_name,
            'programs' => $user->programs()->latest()->get(),
            'courses' => $user->courses()->latest()->get(),
            'reports' => $user->reports()->latest()->get(),
            'tickets' => $user->tickets()->latest()->get(),
        ]);
    }
    public function profile()
    {
        return view('dashboard.profile');
    }

    public function insurance()
    {
        return view('dashboard.insurance');
    }

    public function payments()
    {
        return view('dashboard.payments');
    }

    public function courses()
    {
        return view('dashboard.courses');
    }

    public function programs()
    {
        return view('dashboard.programs');
    }

    public function settings()
    {
        return view('dashboard.settings');
    }

    public function participation()
    {
        return view('dashboard.participation');
    }

    // ----------------- Tickets -------------------
    public function ticketsIndex()
    {
        return view('dashboard.tickets.index');
    }

    public function ticketsCreate()
    {
        return view('dashboard.tickets.create');
    }

    // ----------------- Reports -------------------
    public function reportsIndex()
    {
        return view('dashboard.reports.index');
    }

    public function reportsCreate()
    {
        return view('dashboard.reports.create');
    }

    public function reportsEdit()
    {
        return view('dashboard.reports.edit');
    }

    public function reportsShow()
    {
        return view('dashboard.reports.show');
    }
}
