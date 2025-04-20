<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    public function show(Program $program)
{
    return view('programs.show', compact('program'));
}

    public function index()
    {
        $programs = Program::latest()->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required',
            'execution_date'    => 'required|date',
            'cover_image'       => 'nullable|string',
            'type'              => 'nullable|string',
            'region'            => 'nullable|string',
            'peak_altitude'     => 'nullable|integer',
            'member_cost'       => 'nullable|numeric',
            'guest_cost'        => 'nullable|numeric',
            'required_equipment'=> 'nullable|string',
            'required_meals'    => 'nullable|string',
            'track_url'         => 'nullable|string',
            'status'            => 'nullable|string',
        ]);

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'برنامه با موفقیت ثبت شد.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required',
            'execution_date'    => 'required|date',
            'cover_image'       => 'nullable|string',
            'type'              => 'nullable|string',
            'region'            => 'nullable|string',
            'peak_altitude'     => 'nullable|integer',
            'member_cost'       => 'nullable|numeric',
            'guest_cost'        => 'nullable|numeric',
            'required_equipment'=> 'nullable|string',
            'required_meals'    => 'nullable|string',
            'track_url'         => 'nullable|string',
            'status'            => 'nullable|string',
        ]);

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'برنامه بروزرسانی شد.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'برنامه حذف شد.');
    }
    public function registrations(Program $program)
    {
        $program->load('registrations.user');
        return view('admin.programs.registrations', compact('program'));
    }
    public function archive()
{
    $programs = Program::latest()->paginate(6);
    return view('programs.archive', compact('programs'));
}

}
