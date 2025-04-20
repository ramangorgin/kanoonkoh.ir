<?php

namespace App\Http\Controllers;

use App\Models\Report;

class ReportController extends Controller
{
    public function archive()
    {
        $reports = Report::latest()->paginate(6);
        return view('reports.archive', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }
}
