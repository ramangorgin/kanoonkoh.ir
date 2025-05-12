<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController extends Controller
{
    public function show(Report $report)
    {
        $report->load(['author', 'program']); // eager load
        return view('public.reports.show', compact('report'));
    }
    public function index()
    {
        $reports = \App\Models\Report::latest()->paginate(9);
        return view('public.reports.index', compact('reports'));
    }

}
