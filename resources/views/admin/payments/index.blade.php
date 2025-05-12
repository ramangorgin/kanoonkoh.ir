@extends('admin.layout')

@section('content')
<h4 class="mb-4">پرداخت‌ها</h4>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>کاربر</th>
            <th>نوع</th>
            <th>مبلغ</th>
            <th>کد رهگیری</th>
            <th>وضعیت</th>
            <th>تاریخ</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->user->first_name }}</td>
            <td>{{ $payment->type }}</td>
            <td>{{ number_format($payment->amount) }}</td>
            <td>{{ $payment->tracking_code }}</td>
            <td>{{ $payment->status }}</td>
            <td>{{ jdate($payment->created_at)->format('Y/m/d') }}</td>
            <td>
                <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-secondary">نمایش</a>
                <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-sm btn-primary">تغییر وضعیت</a>
                <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" class="d-inline" onsubmit="return confirm('مطمئن؟')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $payments->links() }}
@endsection
