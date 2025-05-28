@extends('layouts.dashboard')

@section('title', 'ارسال تیکت')

@section('breadcrumb')
    <a href="{{ route('dashboard.index') }}">داشبورد</a> / <span>ارسال تیکت</span>
@endsection

@section('content')

<h5 class="mb-4">ارسال تیکت جدید</h5>

<form method="POST" action="{{ route('dashboard.tickets.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">موضوع</label>
        <input type="text" name="subject" class="form-control" required placeholder="مثلاً مشکل در ثبت‌نام در برنامه ...">
    </div>

    <div class="mb-3">
        <label class="form-label">دسته‌بندی</label>
        <select name="category" class="form-select">
            <option value="">انتخاب کنید...</option>
            <option value="program">برنامه‌ها</option>
            <option value="course">دوره‌ها</option>
            <option value="payment">پرداخت / مالی</option>
            <option value="report">گزارش‌ها</option>
            <option value="other">سایر</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">پیام</label>
        <textarea name="message" rows="6" class="form-control" required placeholder="سؤال یا مشکل خود را به صورت واضح بنویسید..."></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">بارگذاری فایل (اختیاری)</label>
        <input type="file" name="attachment" class="form-control" accept=".pdf,image/*">
    </div>

    <button type="submit" class="btn btn-primary">ارسال تیکت</button>
</form>
@endsection