@extends('admin.layout')

@section('content')
<h4 class="mb-4">جزئیات پرداخت</h4>

<table class="table table-bordered">
    <tr><th>کاربر</th><td>{{ $payment->user->first_name }}</td></tr>
    <tr><th>نوع پرداخت</th><td>{{ $payment->type }}</td></tr>
    @if($payment->type == 'membership')
        <tr><th>سال</th><td>{{ $payment->year }}</td></tr>
    @elseif($related)
        <tr><th>مورد مربوطه</th><td>{{ $related->title }}</td></tr>
    @endif
    <tr><th>مبلغ</th><td>{{ number_format($payment->amount) }} تومان</td></tr>
    <tr><th>کد رهگیری</th><td>{{ $payment->tracking_code }}</td></tr>
    <tr><th>وضعیت</th><td>{{ $payment->status }}</td></tr>
    <tr><th>تاریخ</th><td>{{ jdate($payment->created_at)->format('Y/m/d') }}</td></tr>
</table>

<a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">بازگشت</a>
@endsection
