<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramRegistrationController extends Controller
{
    public function store(Request $request, Program $program)
    {
        $data = $request->validate([
            'reference_id' => 'required|string|max:255',
            'agreement' => 'accepted',
            'name' => 'nullable|string|max:255',
            'national_id' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'emergency_phone' => 'nullable|string|max:20',
        ]);

        $registration = new ProgramRegistration([
            'reference_id' => $data['reference_id'],
            'agreement' => true,
        ]);

        if (Auth::check()) {
            $registration->user_id = Auth::id();
        } else {
            $registration->name = $data['name'];
            $registration->national_id = $data['national_id'];
            $registration->phone = $data['phone'];
            $registration->emergency_phone = $data['emergency_phone'];
        }

        $program->registrations()->save($registration);

        return redirect()->back()->with('success', 'ثبت‌نام با موفقیت انجام شد.');
    }
}
