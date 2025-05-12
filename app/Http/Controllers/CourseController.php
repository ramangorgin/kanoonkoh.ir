<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'date' => 'required|string', // چون تاریخ شمسی متنیه
            'certificate_file' => 'required|file|mimes:jpg,png,pdf|max:2048'
        ]);

        // تبدیل تاریخ شمسی به میلادی
        $gregorianDate = Jalalian::fromFormat('Y/m/d', $validated['date'])->toCarbon();

        $course = Course::create([
            'title' => $validated['title'],
            'provider' => $validated['provider'],
            'date' => $gregorianDate,
            'type' => 'external',
            'created_by' => null,
        ]);

        $filePath = null;
        if ($request->hasFile('certificate_file')) {
            $filePath = $request->file('certificate_file')->store('course_certificates', 'public');
        }

        auth()->user()->courses()->attach($course->id, [
            'certificate_file' => $filePath,
            'submitted_by' => 'user',
            'status' => 'pending',
        ]);

        return back()->with('success', 'دوره با موفقیت ثبت شد و در انتظار تایید است.');
    }
}
