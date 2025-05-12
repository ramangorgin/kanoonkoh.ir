<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['programs', 'courses', 'reports'])->paginate(20);

        $stats = [
            'total' => User::count(),
            'official' => User::where('membership_type', 'like', '%رسمی%')->count(),
            'honorary' => User::where('membership_type', 'عضو افتخاری')->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    public function show(User $user)
    {
        $user->load(['programs', 'courses', 'reports']);
        return view('admin.users.show', compact('user'));
    }
}

