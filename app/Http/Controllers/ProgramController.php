<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = \App\Models\Program::all();
        return view('dashboard.programs', compact('programs'));
    }

    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }
}

