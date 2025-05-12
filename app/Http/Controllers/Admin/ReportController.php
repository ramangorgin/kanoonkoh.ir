<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('user', 'program')->latest()->paginate(15);
        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function create()
    {
        $users = User::all();
        $programs = Program::all();
        return view('admin.reports.create', compact('users', 'programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'photos.*' => 'nullable|image|max:2048',
        ]);

        $photoPaths = [];

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('report_photos', 'public');
            }
        }

        $validated['photos'] = $photoPaths ? json_encode($photoPaths) : null;
        $validated['status'] = 'approved'; // چون توسط ادمین ثبت شده

        Report::create($validated);

        return redirect()->route('admin.reports.index')->with('success', 'گزارش جدید با موفقیت ثبت شد.');
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $report->update(['status' => $request->status]);

        return redirect()->route('admin.reports.index')->with('success', 'وضعیت گزارش بروزرسانی شد.');
    }

    public function destroy(Report $report)
    {
        if ($report->photos) {
            foreach (json_decode($report->photos) as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }

        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'گزارش حذف شد.');
    }
}
