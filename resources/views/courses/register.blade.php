@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">ثبت‌نام در دوره: {{ $course->title }}</h2>

    <div class="alert alert-info">
        مبلغ دوره: <strong>{{ number_format($course->price) }}</strong> تومان
    </div>

    {{-- دکمه تأیید --}}
    <div id="confirm_section">
        <p>در صورتی که مایل به ثبت‌نام در این دوره هستید، روی دکمه زیر کلیک کنید.</p>
        <button type="button" id="confirm_button" class="btn btn-primary">تأیید و ادامه ثبت‌نام</button>
    </div>

    {{-- فرم پرداخت (پنهان تا زمانی که تأیید شود) --}}
    <div id="payment_section" class="d-none mt-4">

        {{-- اطلاعات کارت بانکی --}}
        <div class="alert alert-warning">
            <strong>لطفاً مبلغ دوره را به شماره کارت زیر واریز کنید:</strong><br>
            <ul class="mt-2">
                <li><strong>شماره کارت:</strong> 6037-9918-1234-5678</li>
                <li><strong>شماره شبا:</strong> IR12 0120 0000 0000 5678 9012 34</li>
                <li><strong>بانک:</strong> ملی ایران</li>
                <li><strong>نام دارنده:</strong> کانون کوه</li>
            </ul>
        </div>

        <form method="POST" action="{{ route('courses.register.store', $course->id) }}" enctype="multipart/form-data">
            @csrf

            {{-- کد پیگیری --}}
            <div class="mb-3">
                <label class="form-label">کد پیگیری پرداخت</label>
                <input type="text" name="tracking_code" class="form-control" required>
            </div>

            {{-- تاریخ پرداخت --}}
            <div class="mb-3">
                <label class="form-label">تاریخ پرداخت</label>
                <input type="date" name="paid_at" class="form-control" required>
            </div>

            {{-- فایل فیش --}}
            <div class="mb-3">
                <label class="form-label">بارگذاری فایل فیش (اختیاری)</label>
                <input type="file" name="receipt_file" class="form-control" accept=".pdf,image/*">
            </div>
            <p>
                ثبت‌نام در دوره به منزله پذیرش
                <a href="{{ route('conditions') }}" target="_blank">شرایط عضویت</a>
                می‌باشد.
            </p>
            <button type="submit" class="btn btn-success">ثبت نهایی</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmBtn = document.getElementById('confirm_button');
        const confirmSection = document.getElementById('confirm_section');
        const paymentSection = document.getElementById('payment_section');

        confirmBtn.addEventListener('click', function () {
            confirmSection.classList.add('d-none');
            paymentSection.classList.remove('d-none');
        });
    });
</script>
@endpush
