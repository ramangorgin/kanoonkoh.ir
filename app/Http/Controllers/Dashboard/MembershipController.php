<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $latestTransaction = $user->transactions()->latest()->first();

        return view('dashboard.membership', compact('latestTransaction'));
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

        return back()->with('success', 'درخواست عضویت با موفقیت ثبت شد.');
    }
}
