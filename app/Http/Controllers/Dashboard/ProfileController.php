<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\DateService;
use Morilog\Jalali\Jalalian;  


class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('dashboard.profile', [
            'profile' => $profile,
            'hasProfile' => $profile !== null,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // تاریخ تولد تبدیل‌شده
        $gregorianDate = DateService::convertJalaliToGregorian($request->birth_date);

        // قوانین اعتبارسنجی
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'father_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'birth_date' => 'required|string',
            'national_id' => 'nullable|string',
            'phone' => 'nullable|string',
            'emergency_phone' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'personal_photo' => 'nullable|image|max:2048',
            'blood_type' => 'nullable|string',
            'job' => 'nullable|string',
            'referrer' => 'nullable|string',
            'height_cm' => 'nullable|numeric',
            'weight_kg' => 'nullable|numeric',
            'medical_conditions' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'had_surgery' => 'nullable|boolean',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_relation' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        $validated['birth_date'] = Jalalian::fromFormat('Y-m-d', convertNumbersToEnglish($request->birth_date))
        ->toCarbon()
        ->toDateString();


        $profile = $user->profile;

        if ($request->hasFile('personal_photo')) {
            if ($profile && $profile->personal_photo) {
                Storage::delete($profile->personal_photo);
            }

            $validated['personal_photo'] = $request->file('personal_photo')->store('profiles', 'public');
        }

        // ساخت یا به‌روزرسانی
        if ($profile) {
            $profile->update($validated);
        } else {
            $user->profile()->create($validated);
        }

        return redirect()->back()->with('success', 'مشخصات با موفقیت ذخیره شد.');
    }

  
    
}
function convertNumbersToEnglish($string) {
    $persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    $english = ['0','1','2','3','4','5','6','7','8','9'];
    return str_replace($persian, $english, $string);
}