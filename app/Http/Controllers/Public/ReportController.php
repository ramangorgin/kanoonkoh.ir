<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController extends Controller
{
    public function show(Report $report)
    {
        return view('public.reports.show', compact('report'));
    }
}
