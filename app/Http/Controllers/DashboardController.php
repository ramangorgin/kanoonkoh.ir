<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load([
            'membershipPayments',
            'tickets',
            'sportInsurances', 
        ]);

        return view('user.dashboard', compact('user'));
    }
}
