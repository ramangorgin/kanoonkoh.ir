<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\User;

class AdminProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $users = User::all(); 
        return view('admin.programs.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string',
            'departure_tehran_datetime' => 'nullable|string',
            'departure_karaj_datetime' => 'nullable|string',
            'registration_deadline' => 'nullable|string',
            'title' => 'required|string|max:255',
            'has_transport' => 'required|in:0,1',
            'departure_place_tehran' => 'nullable|required_if:has_transport,1',
            'departure_lat_tehran' => 'nullable|required_if:has_transport,1',
            'departure_lon_tehran' => 'nullable|required_if:has_transport,1',
            'departure_place_karaj' => 'nullable|required_if:has_transport,1',
            'departure_lat_karaj' => 'nullable|required_if:has_transport,1',
            'departure_lon_karaj' => 'nullable|required_if:has_transport,1',
            'required_equipment' => 'nullable|array',
            'required_meals' => 'nullable|array',
            'is_free' => 'required|in:0,1',
            'member_cost' => 'required_if:is_free,0|nullable|numeric|min:0',
            'guest_cost' => 'required_if:is_free,0|nullable|numeric|min:0',
            'card_number' => 'nullable|required_if:is_free,0',
            'sheba_number' => 'nullable|required_if:is_free,0',
            'card_holder' => 'nullable|required_if:is_free,0',
            'bank_name' => 'nullable|required_if:is_free,0',
            'is_registration_open' => 'required|in:0,1',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|max:2048',
        ]);

        $validated['required_equipment'] = is_array($request->required_equipment) ? implode(',', $request->required_equipment) : null;
        $validated['required_meals'] = is_array($request->required_meals) ? implode(',', $request->required_meals) : null;
        unset($validated['photos']);
        $program = Program::create($validated);
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('program_photos', 'public');
                $program->photos()->create([
                    'path' => $path
                ]);
            }
        }
   
        foreach ($request->roles as $role) {
            if (!empty($role['user_id'])) {
                $program->userRoles()->create([
                    'user_id' => $role['user_id'],
                    'role_title' => $role['role_title'],
                ]);
            } elseif (!empty($role['custom_name'])) {
                $program->userRoles()->create([
                    'user_id' => null,
                    'role_title' => $role['role_title'],
                    'user_name' => $role['custom_name'],
                ]);
            }
        }
    
        return redirect()->route('admin.programs.index')->with('success', 'برنامه با موفقیت ثبت شد.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'برنامه با موفقیت حذف شد.');
    }
    public function show(Program $program)
    {
        $program->load('roles.user'); 
        return view('admin.programs.show', compact('program'));
    }
    

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([

            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string',
            'departure_tehran_datetime' => 'nullable|string',
            'departure_karaj_datetime' => 'nullable|string',
            'registration_deadline' => 'nullable|string',
            'title' => 'required|string|max:255',
            'has_transport' => 'required|in:0,1',
            'departure_place_tehran' => 'nullable|required_if:has_transport,1',
            'departure_lat_tehran' => 'nullable|required_if:has_transport,1',
            'departure_lon_tehran' => 'nullable|required_if:has_transport,1',
            'departure_place_karaj' => 'nullable|required_if:has_transport,1',
            'departure_lat_karaj' => 'nullable|required_if:has_transport,1',
            'departure_lon_karaj' => 'nullable|required_if:has_transport,1',
            'required_equipment' => 'nullable|array',
            'required_meals' => 'nullable|array',
            'is_free' => 'required|in:0,1',
            'member_cost' => 'required_if:is_free,0|nullable|numeric|min:0',
            'guest_cost' => 'required_if:is_free,0|nullable|numeric|min:0',
            'card_number' => 'nullable|required_if:is_free,0',
            'sheba_number' => 'nullable|required_if:is_free,0',
            'card_holder' => 'nullable|required_if:is_free,0',
            'bank_name' => 'nullable|required_if:is_free,0',
            'is_registration_open' => 'required|in:0,1',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|max:2048',
        ]);

        $validated['required_equipment'] = is_array($request->required_equipment) ? implode(',', $request->required_equipment) : null;
        $validated['required_meals'] = is_array($request->required_meals) ? implode(',', $request->required_meals) : null;
        unset($validated['photos']);
        $program = Program::create($validated);
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('program_photos', 'public');
                $program->photos()->create([
                    'path' => $path
                ]);
            }
        }
        foreach ($request->roles as $role) {
            if (!empty($role['user_id'])) {
                $program->userRoles()->create([
                    'user_id' => $role['user_id'],
                    'role_title' => $role['role_title'],
                ]);
            } elseif (!empty($role['custom_name'])) {
                $program->userRoles()->create([
                    'user_id' => null,
                    'role_title' => $role['role_title'],
                    'user_name' => $role['custom_name'],
                ]);
            }
        }
    

        $program->update($validated);


        return redirect()->route('admin.programs.index')->with('success', 'برنامه با موفقیت بروزرسانی شد.');
    }
}
