<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Transaction;
use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function index()
    {
        return $this->prepareMembershipData();
    }

    public function create()
    {
        return $this->prepareMembershipData();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:membership,course,program',
            'year' => 'nullable|integer',
            'related_id' => 'nullable|integer',
            'transaction_code' => 'required|string',
            'receipt_file' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('receipt_file')) {
            $data['receipt_file'] = $request->file('receipt_file')->store('receipts', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['approved'] = false;

        Membership::create($data);

        return redirect()->route('dashboard.membership')->with('success', 'ثبت انجام شد.');
    }

    protected function prepareMembershipData()
    {
        $user = auth()->user();

        return view('dashboard.membership', [
            'latestTransaction' => optional($user->transactions()->latest()->first()),
            'recentCourses' => Course::latest()->take(5)->get(),
            'recentPrograms' => Program::latest()->take(5)->get(),
            'membershipYears' => range(now()->year, now()->year - 5),
            'programs' => Program::all(),
        ]);
    }
}
