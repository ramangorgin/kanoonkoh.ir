<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Auth::user()->reports()->latest()->get();
        return view('dashboard.reports.index', compact('reports'));
    }    

    public function create()
    {
        $programs = Auth::user()->programs; // فقط برنامه‌هایی که شرکت کرده
        return view('dashboard.reports.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'program_id' => 'nullable|exists:programs,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photos.*' => 'nullable|image|max:2048',
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('reports/photos', 'public');
            }
        }

        Report::create([
            'user_id' => Auth::id(),
            'program_id' => $data['program_id'] ?? null,
            'title' => $data['title'],
            'content' => $data['content'],
            'photos' => $photoPaths,
            'approved' => false,
        ]);

        return redirect()->route('dashboard.reports.index')->with('success', 'گزارش با موفقیت ارسال شد و پس از تایید نمایش داده خواهد شد.');
    }

    public function show(Report $report)
    {
        $this->authorize('view', $report); // optional: برای جلوگیری از مشاهده گزارش دیگران
        return view('dashboard.reports.show', compact('report'));
    }
}
