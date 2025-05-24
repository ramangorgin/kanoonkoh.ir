<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsuranceController extends Controller
{
    public function show()
    {
        return view('dashboard.insurance');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'insurance_number' => 'nullable|string',
            'issued_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'file' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('insurances', 'public');
        }

        $data['user_id'] = Auth::id();

        Insurance::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return redirect()->back()->with('success', 'بیمه با موفقیت ثبت شد.');
    }

    public function update(Request $request)
    {
        $insurance = Auth::user()->insurance;

        $validated = $request->validate([
            'insurance_number' => 'required|string|max:255',
            'issued_at' => 'required|date',
            'expires_at' => 'required|date|after_or_equal:issued_at',
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('insurances', 'public');
        }

        if ($insurance) {
            $insurance->update($validated);
        } else {
            $validated['user_id'] = Auth::id();
            Insurance::create($validated);
        }

        return back()->with('success', 'اطلاعات بیمه با موفقیت بروزرسانی شد.');
    }
}
