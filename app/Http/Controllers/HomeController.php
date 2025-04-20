<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Course;
use App\Models\Report;

class HomeController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'programs' => Program::latest()->take(3)->get(),
            'reports' => Report::latest()->take(3)->get(),
            'courses' => Course::latest()->take(3)->get(),
        ]);
    }
    
}
