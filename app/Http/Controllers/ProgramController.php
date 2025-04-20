<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramController extends Controller
{
    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }

    public function archive()
    {
        $programs = Program::latest()->paginate(6);
        return view('programs.archive', compact('programs'));
    }
}

