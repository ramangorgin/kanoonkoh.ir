<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Program;
use App\Models\Course;

class UserPaymentController extends Controller
{
  
    public function index()
    {
        $payments = auth()->user()->payments()->latest()->get();
        $programs = Program::latest()->take(10)->get();
        $courses = Course::latest()->take(10)->get();

        return view('dashboard.tabs.payments', compact('payments', 'programs', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:membership,program,course',
            'related_id' => 'nullable|string|max:100',
            'amount' => 'required|numeric|min:1000',
            'transaction_code' => 'required|string|max:100',
        ]);

        Payment::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'related_id' => $request->related_id,
            'amount' => $request->amount,
            'transaction_code' => $request->transaction_code,
        ]);

        return back()->with('success', 'پرداخت با موفقیت ثبت شد.');
    }
}