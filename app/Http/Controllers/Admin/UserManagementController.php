<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with(['programRegistrations.program', 'courseRegistrations.course', 'reports'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['programRegistrations.program', 'courseRegistrations.course', 'reports']);
        return view('admin.users.show', compact('user'));
    }
}
