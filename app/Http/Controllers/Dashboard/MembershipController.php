<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Transaction;
use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;


class MembershipController extends Controller
{
    /**
     * نمایش فرم پرداخت (هم create هم index از این استفاده می‌کنند)
     */
    public function index()
    {
        return $this->prepareMembershipData();
    }

    public function create()
    {
        return $this->prepareMembershipData();
    }

    /**
     * ذخیره پرداخت جدید
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:membership,course,program',
            'year' => 'nullable|integer',
            'related_id' => 'nullable|integer',
            'transaction_code' => 'required|string',
            'receipt_file' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('receipt_file')) {
            $data['receipt_file'] = $request->file('receipt_file')->store('receipts', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['approved'] = false;

        Membership::create($data);

        return redirect()->route('dashboard.membership')->with('success', 'پرداخت با موفقیت ثبت شد.');
    }

    /**
     * آماده‌سازی داده‌ها برای نمایش فرم
     */
    protected function prepareMembershipData()
    {
        $user = auth()->user();

        $jalaliYears = collect(range(now()->year, now()->year - 5))
            ->map(fn($year) => [
                'gregorian' => $year,
                'jalali' => Jalalian::fromDateTime("$year-03-21")->getYear(),
            ]);

        return view('dashboard.membership', [
            'latestTransaction' => optional($user->transactions()->latest()->first()),
            'recentCourses' => Course::latest()->take(5)->get(),
            'recentPrograms' => Program::latest()->take(5)->get(),
            'membershipYears' => $jalaliYears,
            'programs' => Program::all(),
        ]);
    }
}