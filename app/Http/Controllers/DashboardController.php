<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();

        $rules = [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',

            // فیلدهای جدول user_profiles
            'father_name' => 'nullable|string|max:100',
            'birth_date' => 'nullable|string',
            'national_id' => 'nullable|string|size:10',
            'gender' => 'nullable|in:male,female,other',
            'mobile' => 'nullable|string|max:20',
            'province' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:50',
            'insurance_number' => 'nullable|string|max:50',
            'insurance_issue_date' => 'nullable|string',
            'insurance_expiration_date' => 'nullable|string',
            'insurance_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'health_conditions' => 'nullable|string|max:255',
            'allergies' => 'nullable|string|max:255',
            'experience_level' => 'nullable|in:beginner,intermediate,advanced',
            'personal_equipment' => 'nullable|string|max:255',
            'completed_courses' => 'nullable|string|max:255',
            'id_card_scan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];

        Validator::make($data, $rules)->validate();

        // به‌روزرسانی اطلاعات اصلی user
        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ]);

        // تبدیل تاریخ شمسی به میلادی
        if (!empty($data['birth_date'])) {
            $data['birth_date'] = Jalalian::fromFormat('Y/m/d', $data['birth_date'])->toCarbon();
        }

        if (!empty($data['insurance_issue_date'])) {
            $data['insurance_issue_date'] = Jalalian::fromFormat('Y/m/d', $data['insurance_issue_date'])->toCarbon();
        }

        if (!empty($data['insurance_expiration_date'])) {
            $data['insurance_expiration_date'] = Jalalian::fromFormat('Y/m/d', $data['insurance_expiration_date'])->toCarbon();
        }

        // آپلود فایل‌ها
        if ($request->hasFile('insurance_file')) {
            $data['insurance_file'] = $request->file('insurance_file')->store('insurance_files', 'public');
        }

        if ($request->hasFile('id_card_scan')) {
            $data['id_card_scan'] = $request->file('id_card_scan')->store('id_cards', 'public');
        }

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // لیست‌ها به JSON
        $data['personal_equipment'] = $request->filled('personal_equipment')
            ? json_encode(array_map('trim', explode(',', $request->personal_equipment)))
            : null;

        $data['completed_courses'] = $request->filled('completed_courses')
            ? json_encode(array_map('trim', explode(',', $request->completed_courses)))
            : null;

        // ذخیره پروفایل (update or create)
        $user->profile()->updateOrCreate([], $data);

        return back()->with('success', 'پروفایل با موفقیت به‌روزرسانی شد.');
    }
}
