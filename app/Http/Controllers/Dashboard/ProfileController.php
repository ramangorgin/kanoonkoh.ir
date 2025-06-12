<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\DateService;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;
    
        return view('dashboard.profile', [
            'profile' => $profile,
            'hasProfile' => $profile !== null
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

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
            'weight_km' => 'nullable|numeric',
            'medical_conditions' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'had_surgery' => 'nullable|boolean',
            'emergency_person_name' => 'nullable|string',
            'emergency_person_relation' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        try {
            $validated['birth_date'] = DateService::convertJalaliToGregorian($request->birth_date);
        } catch (\Exception $e) {
            return back()->withErrors(['birth_date' => 'تاریخ وارد شده نامعتبر است'])->withInput();
        }

        if ($request->hasFile('personal_photo')) {
            $validated['personal_photo'] = $request->file('personal_photo')->store('profile_photos', 'public');
        }

        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);
        $profile->fill($validated);
        $profile->role = 'member'; 
        $profile->save();

        return redirect()->route('dashboard.profile')->with('success', 'مشخصات با موفقیت ذخیره شد.');
    }

}