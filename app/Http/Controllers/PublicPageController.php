<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Course;
use App\Models\Report;

class PublicPageController extends Controller
{
    public function home()
    {
        $programs = Program::latest()->take(3)->get();
        $courses = Course::latest()->take(3)->get();
        $reports = Report::latest()->take(3)->get();

        return view('public.home', compact('programs', 'courses', 'reports'));
    }

    public function programs()
    {
        $programs = \App\Models\Program::latest()->paginate(12);
        return view('public.programs', compact('programs'));
    }
    
    public function courses()
    {
        $courses = \App\Models\Course::latest()->paginate(12);
        return view('public.courses', compact('courses'));
    }
    
    public function reports()
    {
        $reports = \App\Models\Report::latest()->paginate(12);
        return view('public.reports', compact('reports'));
    }
    

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }
}
