<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Auth;

class InsuranceController extends Controller
{
    public function show()
    {
        return view('dashboard.insurance');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'issued_at' => 'required|string',
            'expires_at' => 'required|string',
            'file_path' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $validated['issued_at'] = Jalalian::fromFormat('Y-m-d', convertNumbersToEnglish($validated['issued_at']))->toCarbon()->toDateString();
        $validated['expires_at'] = Jalalian::fromFormat('Y-m-d', convertNumbersToEnglish($validated['expires_at']))->toCarbon()->toDateString();

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('insurances', 'public');
        }

        $validated['user_id'] = Auth::id();

        Insurance::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return redirect()->back()->with('success', 'بیمه با موفقیت ثبت شد.');
    }


}

function convertNumbersToEnglish($string) {
    $persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    $english = ['0','1','2','3','4','5','6','7','8','9'];
    return str_replace($persian, $english, $string);
}

