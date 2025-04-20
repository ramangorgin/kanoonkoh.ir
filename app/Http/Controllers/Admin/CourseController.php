<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'cover_image'      => 'nullable|string',
            'schedule_date'    => 'required|date',
            'schedule_time'    => 'required|string',
            'capacity'         => 'nullable|integer',
            'instructor_id'    => 'nullable|integer',
            'has_certificate'  => 'nullable|boolean',
            'cost'             => 'nullable|numeric',
        ]);

        Course::create($data);

        return redirect()->route('admin.courses.index')->with('success', 'دوره با موفقیت ایجاد شد.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'cover_image'      => 'nullable|string',
            'schedule_date'    => 'required|date',
            'schedule_time'    => 'required|string',
            'capacity'         => 'nullable|integer',
            'instructor_id'    => 'nullable|integer',
            'has_certificate'  => 'nullable|boolean',
            'cost'             => 'nullable|numeric',
        ]);

        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success', 'دوره با موفقیت ویرایش شد.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'دوره حذف شد.');
    }
}
