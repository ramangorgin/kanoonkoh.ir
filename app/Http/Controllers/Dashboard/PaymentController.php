<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;



class PaymentController extends Controller
{

    public function index()
    {
        $currentYear = Jalalian::now()->getYear();
        $membershipYears = [];
    
        for ($i = -5; $i <= 5; $i++) {
            $membershipYears[] = $currentYear + $i;
        }
    
        return view('dashboard.payments', compact('membershipYears'));
    }

    public function create()
    {
        return $this->preparePaymentData();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:Payment,course,program',
            'year' => 'nullable|integer',
            'related_id' => 'nullable|integer',
            'transaction_code' => 'required|string',
            'receipt_file' => 'nullable|file|max:2048',
            'date' => 'required|date',
        ]);

        if ($request->hasFile('receipt_file')) {
            $data['receipt_file'] = $request->file('receipt_file')->store('receipts', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['approved'] = false;

        Payment::create($data);

        return redirect()->route('dashboard.payments')->with('success', 'پرداخت با موفقیت ثبت شد.');
    }

    protected function preparePaymentData()
    {
        $user = auth()->user();

        $jalaliYears = collect(range(now()->year, now()->year - 5))
            ->map(fn($year) => [
                'gregorian' => $year,
                'jalali' => Jalalian::fromDateTime("$year-03-21")->getYear(),
            ]);

        return view('dashboard.payments', [
            'latestTransaction' => optional($user->transactions()->latest()->first()),
            'recentCourses' => Course::latest()->take(5)->get(),
            'recentPrograms' => Program::latest()->take(5)->get(),
            'PaymentYears' => $jalaliYears,
            'programs' => Program::all(),
        ]);
    }
}