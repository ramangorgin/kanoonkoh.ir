<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Models\Program;
use App\Models\Course;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user')->latest()->paginate(20);
        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $related = null;

        if ($payment->type === 'program') {
            $related = Program::find($payment->related_id);
        } elseif ($payment->type === 'course') {
            $related = Course::find($payment->related_id);
        }

        return view('admin.payments.show', compact('payment', 'related'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $payment->update(['status' => $request->status]);

        return redirect()->route('admin.payments.index')->with('success', 'وضعیت پرداخت بروزرسانی شد.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return back()->with('success', 'پرداخت حذف شد.');
    }
}
