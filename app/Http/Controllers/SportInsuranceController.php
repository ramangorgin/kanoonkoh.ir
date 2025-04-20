<?php

namespace App\Http\Controllers;

use App\Models\SportInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class SportInsuranceController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'expiration_date' => 'required|date',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('file')->store('insurance', 'public');

        SportInsurance::create([
            'user_id' => Auth::id(),
            'expiration_date' => $request->expiration_date,
            'file_path' => $path
        ]);
        

        return back()->with('success', 'بیمه ورزشی با موفقیت ثبت شد.');
    }


}

