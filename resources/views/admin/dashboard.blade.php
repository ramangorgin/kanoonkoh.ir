@extends('layout')

@section('title', 'پنل مدیریت')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-primary">داشبورد مدیریت کانون کوه</h2>

    <div class="row g-4 mb-5 text-center">
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-4 border-primary">
                <div class="card-body">
                    <h5 class="card-title">کاربران</h5>
                    <h2>{{ $userCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-4 border-success">
                <div class="card-body">
                    <h5 class="card-title">برنامه‌ها</h5>
                    <h2>{{ $programCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-4 border-warning">
                <div class="card-body">
                    <h5 class="card-title">دوره‌ها</h5>
                    <h2>{{ $courseCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-4 border-danger">
                <div class="card-body">
                    <h5 class="card-title">گزارش‌ها</h5>
                    <h2>{{ $reportCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- جدیدترین پرداخت‌های در انتظار تایید --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">پرداخت‌های اخیر در انتظار تأیید</h5>
        </div>
        <div class="card-body p-0">
            @if($pendingPayments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0">
                        <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>مبلغ</th>
                                <th>کد رهگیری</th>
                                <th>تاریخ</th>
                                <th>اقدامات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingPayments as $payment)
                                <tr>
                                    <td>{{ $payment->user->first_name }} {{ $payment->user->last_name }}</td>
                                    <td>{{ number_format($payment->amount) }} تومان</td>
                                    <td>{{ $payment->reference_id }}</td>
                                    <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($payment->created_at)->format('Y/m/d') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('membership.payment.approve', $payment->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-success">تأیید</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="p-3 text-muted">هیچ پرداختی در انتظار تأیید نیست.</p>
            @endif
        </div>
    </div>
</div>
@endsection
