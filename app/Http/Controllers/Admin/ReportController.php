<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();
        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'date'             => 'required|date',
            'type'             => 'nullable|string',
            'area'             => 'nullable|string',
            'peak_name'        => 'nullable|string',
            'peak_height'      => 'nullable|integer',
            'duration'         => 'nullable|string',
            'start_location'   => 'nullable|string',
            'participant_count'=> 'nullable|integer',
            'cover_image'      => 'nullable|string',
            'pdf_path'         => 'nullable|string',
            'track_url'        => 'nullable|string',
            'route_points'     => 'nullable|json',
            'execution_schedule' => 'nullable|json',
            'full_report'      => 'nullable|string',
            'leader_id'        => 'nullable|integer',
            'assistant_leader_id' => 'nullable|integer',
            'technical_manager_id' => 'nullable|integer',
            'support_id'       => 'nullable|integer',
            'guide_id'         => 'nullable|integer',
            'author_id'        => 'nullable|integer',
        ]);

        Report::create($data);

        return redirect()->route('admin.reports.index')->with('success', 'گزارش با موفقیت ثبت شد.');
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'date'             => 'required|date',
            'type'             => 'nullable|string',
            'area'             => 'nullable|string',
            'peak_name'        => 'nullable|string',
            'peak_height'      => 'nullable|integer',
            'duration'         => 'nullable|string',
            'start_location'   => 'nullable|string',
            'participant_count'=> 'nullable|integer',
            'cover_image'      => 'nullable|string',
            'pdf_path'         => 'nullable|string',
            'track_url'        => 'nullable|string',
            'route_points'     => 'nullable|json',
            'execution_schedule' => 'nullable|json',
            'full_report'      => 'nullable|string',
            'leader_id'        => 'nullable|integer',
            'assistant_leader_id' => 'nullable|integer',
            'technical_manager_id' => 'nullable|integer',
            'support_id'       => 'nullable|integer',
            'guide_id'         => 'nullable|integer',
            'author_id'        => 'nullable|integer',
        ]);

        $report->update($data);

        return redirect()->route('admin.reports.index')->with('success', 'گزارش با موفقیت بروزرسانی شد.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'گزارش حذف شد.');
    }
}
