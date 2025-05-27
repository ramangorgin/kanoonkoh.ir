<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user()->profile;
        return view('dashboard.profile', compact('profile'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'father_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'birth_date' => 'nullable|string',
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
            'introducer' => 'nullable|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'physical_condition' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'had_surgery' => 'nullable|boolean',
            'emergency_person_name' => 'nullable|string',
            'emergency_person_relation' => 'nullable|string',
            'previous_courses' => 'nullable|array',
            'previous_courses.*.title' => 'nullable|string',
            'previous_courses.*.certificate' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('personal_photo')) {
            $validated['personal_photo'] = $request->file('personal_photo')->store('profile_photos', 'public');
        }

        $courses = [];
        if ($request->previous_courses) {
            foreach ($request->previous_courses as $index => $course) {
                if (isset($course['certificate'])) {
                    $filename = $course['certificate']->store("profiles/certificates", 'public');
                    $courses[] = [
                        'title' => $course['title'],
                        'certificate' => $filename,
                    ];
                }
            }
            $data['previous_courses'] = $courses;
        }

        $data['user_id'] = Auth::id();

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        // اطمینان از وجود پروفایل یا ایجاد آن
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);

        $profile->fill($validated);
        $profile->role = 'member'; // پیش‌فرض نقش
        $profile->save();

        return redirect()->route('dashboard.profile')->with('success', 'مشخصات با موفقیت ذخیره شد.');
    }
}