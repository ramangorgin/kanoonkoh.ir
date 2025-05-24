<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{   
    public function update(Request $request)
    {
        $user = Auth::user();
    
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'gender'     => 'required|in:male,female',
            'national_code' => 'required|string|size:10',
            'birth_date' => 'required|date',
            'father_name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|max:2048',
            'phone'       => 'required|string|max:20',
            'emergency_phone' => 'required|string|max:20',
            'province'    => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'address'     => 'required|string|max:500',
            'postal_code' => 'nullable|string|max:20',
        ]);
    
        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }
    
        $user->profile()->updateOrCreate([], $validated);
    
        return redirect()->route('dashboard.profile')->with('success', 'مشخصات با موفقیت به‌روزرسانی شد.');
    }
    
    public function show()
    {
        $profile = Auth::user()->profile;
        return view('dashboard.profile', compact('profile'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date',
            'father_name' => 'nullable|string',
            'national_id' => 'nullable|string|unique:profiles,national_id',
            'personal_photo' => 'nullable|image|max:2048',

            'phone' => 'nullable|string',
            'emergency_phone' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|string',

            'previous_courses' => 'nullable|array',
            'previous_courses.*.title' => 'nullable|string',
            'previous_courses.*.certificate' => 'nullable|file|max:2048',
        ]);

        // فایل عکس پرسنلی
        if ($request->hasFile('personal_photo')) {
            $data['personal_photo'] = $request->file('personal_photo')->store('profiles/photos', 'public');
        }

        // فایل‌های دوره‌های قبلی
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

        return redirect()->back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    }
}

