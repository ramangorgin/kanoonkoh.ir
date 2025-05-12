<?php

namespace App\Http\Controllers;

use App\Models\CourseRequest;
use Morilog\Jalali\Jalalian;
use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;

class UserCourseController extends Controller
{
    public function register(Request $request, Course $course)
    {
        if (!$course->is_registration_open || $course->end_date < now()) {
            return back()->with('error', 'مهلت ثبت‌نام در این دوره به پایان رسیده است.');
        }

        // اگر کاربر عضو باشه
        $rules = [];

        if (auth()->check()) {
            if (!$course->is_free) {
                $rules['transaction_code'] = 'required|string|max:100';
            }
        } else {
            $rules = [
                'guest_name' => 'required|string|max:100',
                'guest_phone' => 'required|string|max:20',
                'guest_national_id' => 'required|string|size:10',
            ];
            if (!$course->is_free) {
                $rules['transaction_code'] = 'required|string|max:100';
            }
        }

        $rules['agree'] = 'accepted';

        $validated = $request->validate($rules);

        // ذخیره در جدول ثبت‌نام
        $registration = new CourseRegistration([
            'user_id' => auth()->id(),
            'guest_name' => $request->guest_name,
            'guest_phone' => $request->guest_phone,
            'guest_national_id' => $request->guest_national_id,
            'transaction_code' => $request->transaction_code,
            'status' => 'pending',
        ]);

        $course->registrations()->save($registration);

        return back()->with('success', 'ثبت‌نام شما با موفقیت انجام شد و در انتظار تایید است.');
    }


    public function requestCourse(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'provider' => 'nullable|string|max:255',
            'teacher' => 'nullable|string|max:255',
            'suggested_date' => 'nullable|string'
        ]);

        $suggestedDate = $request->filled('suggested_date')
            ? Jalalian::fromFormat('Y/m/d', $request->suggested_date)->toCarbon()
            : null;

        CourseRequest::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'provider' => $request->provider,
            'teacher' => $request->teacher,
            'suggested_date' => $suggestedDate,
        ]);

        return back()->with('success', 'درخواست شما ثبت شد و در انتظار بررسی است.');
    }
}