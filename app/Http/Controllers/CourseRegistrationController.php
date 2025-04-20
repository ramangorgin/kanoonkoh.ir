<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRegistrationController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'reference_id' => 'required|string|max:255',
            'agreement' => 'accepted',
            'name' => 'nullable|string|max:255',
            'national_id' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'emergency_phone' => 'nullable|string|max:20',
        ]);

        $registration = new CourseRegistration([
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

        $course->registrations()->save($registration);

        return redirect()->back()->with('success', 'ثبت‌نام شما با موفقیت انجام شد.');
    }
}
