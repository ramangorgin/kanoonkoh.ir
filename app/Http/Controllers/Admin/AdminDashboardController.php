<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Program;
use App\Models\Course;
use App\Models\Report;
use App\Models\MembershipPayment;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'userCount' => User::count(),
            'programCount' => Program::count(),
            'courseCount' => Course::count(),
            'reportCount' => Report::count(),
            'pendingPayments' => MembershipPayment::where('status', 'در انتظار')
                                    ->with('user')
                                    ->latest()
                                    ->take(5)
                                    ->get(),
        ]);
    }
}
