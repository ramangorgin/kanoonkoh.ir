<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\CourseRegistration;

class CourseController extends Controller
{
    public function registrations(Course $course)
    {
        $registrations = $course->registrations()->latest()->get();
        return view('admin.courses.registrations', compact('course', 'registrations'));
    }

    public function approveRegistration(CourseRegistration $registration)
    {
        $registration->update(['status' => 'approved']);
        return back()->with('success', 'ثبت‌نام تایید شد.');
    }

    public function rejectRegistration(CourseRegistration $registration)
    {
        $registration->update(['status' => 'rejected']);
        return back()->with('warning', 'ثبت‌نام رد شد.');
    }

    public function index()
    {
        $courses = Course::latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'provider' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'location_name' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric',
            'lon' => 'nullable|numeric',
            'certificate_required' => 'boolean',
            'requirements' => 'nullable|string',
            'notes_for_participants' => 'nullable|string',
            'member_cost' => 'nullable|integer',
            'guest_cost' => 'nullable|integer',
            'card_number' => 'nullable|string|max:32',
            'sheba_number' => 'nullable|string|max:50',
            'card_holder' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:100',
            'capacity' => 'nullable|integer',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('course_covers', 'public');
        }

        $validated['is_registration_open'] = true;
        $validated['status'] = 'پیش‌رو';
        $validated['created_by'] = auth()->id();

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'دوره با موفقیت ایجاد شد.');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'provider' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'location_name' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric',
            'lon' => 'nullable|numeric',
            'certificate_required' => 'boolean',
            'requirements' => 'nullable|string',
            'notes_for_participants' => 'nullable|string',
            'member_cost' => 'nullable|integer',
            'guest_cost' => 'nullable|integer',
            'card_number' => 'nullable|string|max:32',
            'sheba_number' => 'nullable|string|max:50',
            'card_holder' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:100',
            'capacity' => 'nullable|integer',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($course->cover_image) {
                Storage::disk('public')->delete($course->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('course_covers', 'public');
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'دوره با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(Course $course)
    {
        if ($course->cover_image) {
            Storage::disk('public')->delete($course->cover_image);
        }

        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'دوره حذف شد.');
    }
}
