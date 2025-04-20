<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MembershipPayment;

class MembershipPaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'reference_id' => 'required|string|max:255'
        ]);

        MembershipPayment::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'reference_id' => $request->reference_id,
            'status' => 'در انتظار',
        ]);

        return back()->with('success', 'اطلاعات پرداخت شما ثبت شد و در انتظار بررسی است.');
    }
}
