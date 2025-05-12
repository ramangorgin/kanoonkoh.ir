<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ProgramRegistration;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(15);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'execution_date' => 'required|date',
            'type' => 'nullable|string',
            'difficulty_level' => 'nullable|string',
            'peak_altitude' => 'nullable|integer',
            'capacity' => 'nullable|integer',
            'member_cost' => 'nullable|integer',
            'guest_cost' => 'nullable|integer',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);
    
        // ساخت slug یکتا از عنوان
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
    
        // آپلود تصویر کاور در صورت وجود
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('program_covers', 'public');
        }
    
        Program::create($validated);
    
        return redirect()->route('admin.programs.index')->with('success', 'برنامه جدید با موفقیت ایجاد شد.');
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'execution_date' => 'required|date',
            'type' => 'nullable|string',
            'difficulty_level' => 'nullable|string',
            'peak_altitude' => 'nullable|integer',
            'capacity' => 'nullable|integer',
            'member_cost' => 'nullable|integer',
            'guest_cost' => 'nullable|integer',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        // اگر کاربر تصویر جدید بارگذاری کرده باشد
        if ($request->hasFile('cover_image')) {
            if ($program->cover_image) {
                Storage::disk('public')->delete($program->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('program_covers', 'public');
        }

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'برنامه با موفقیت ویرایش شد.');
    }



    public function destroy(Program $program)
    {
        // حذف تصویر کاور (در صورت وجود)
        if ($program->cover_image) {
            Storage::disk('public')->delete($program->cover_image);
        }

        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'برنامه با موفقیت حذف شد.');
    }

    public function registrations(Program $program)
    {
        $registrations = $program->registrations()->latest()->get();
        return view('admin.programs.registrations', compact('program', 'registrations'));
    }

    public function approveRegistration(ProgramRegistration $registration)
    {
        $registration->update(['status' => 'approved']);
        return back()->with('success', 'ثبت‌نام تایید شد.');
    }

    public function rejectRegistration(ProgramRegistration $registration)
    {
        $registration->update(['status' => 'rejected']);
        return back()->with('warning', 'ثبت‌نام رد شد.');
    }



}