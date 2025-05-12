<?php

namespace App\Http\Controllers;

use App\Models\ProgramRequest;
use Morilog\Jalali\Jalalian;
use App\Models\Program;
use App\Models\ProgramRegistration;
use Illuminate\Http\Request;

class UserProgramController extends Controller
{
  
    public function request(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'leader' => 'nullable|string|max:255',
            'suggested_date' => 'nullable|string',
        ]);

        $suggestedDate = $request->filled('suggested_date')
            ? Jalalian::fromFormat('Y/m/d', $request->suggested_date)->toCarbon()
            : null;

        ProgramRequest::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'region' => $request->region,
            'leader' => $request->leader,
            'suggested_date' => $suggestedDate,
            'status' => 'pending',
        ]);

        return back()->with('success', 'پیشنهاد شما ثبت شد و در انتظار بررسی است.');
    }



public function register(Request $request, Program $program)
{
    // بررسی اینکه برنامه باز هست
    if (!$program->is_registration_open || $program->registration_deadline < now()) {
        return back()->with('error', 'مهلت ثبت‌نام به پایان رسیده است.');
    }

    // بررسی ظرفیت
    if ($program->max_participants) {
        $registered = $program->registrations()->count();
        if ($registered >= $program->max_participants) {
            return back()->with('error', 'ظرفیت برنامه تکمیل شده است.');
        }
    }

    // اعتبارسنجی
    $rules = [];

    if (auth()->check()) {
        $rules['pickup_location'] = 'required_if:' . $program->has_transport . ',1';
        if (!$program->is_free) {
            $rules['transaction_code'] = 'required|string';
        }
    } else {
        $rules = [
            'guest_name' => 'required|string|max:100',
            'guest_phone' => 'required|string|max:20',
            'guest_national_id' => 'required|string|size:10',
        ];
    }

    $rules['agree'] = 'accepted';

    $validated = $request->validate($rules);

    // ثبت در جدول ثبت‌نام‌ها
    $registration = new ProgramRegistration([
        'user_id' => auth()->id(),
        'guest_name' => $request->guest_name,
        'guest_phone' => $request->guest_phone,
        'guest_national_id' => $request->guest_national_id,
        'pickup_location' => $request->pickup_location,
        'transaction_code' => $request->transaction_code,
        'status' => 'pending',
    ]);

    $program->registrations()->save($registration);

    return back()->with('success', 'ثبت‌نام با موفقیت انجام شد. منتظر تایید باشید.');
}

}