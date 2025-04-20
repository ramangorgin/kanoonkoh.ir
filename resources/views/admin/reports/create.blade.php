@extends('layout')

@section('title', 'افزودن گزارش جدید')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">افزودن گزارش برنامه</h2>

    <form action="{{ route('admin.reports.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">عنوان</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">تاریخ اجرا</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">نوع برنامه</label>
            <input type="text" name="type" class="form-control" placeholder="کوهنوردی سبک / متوسط / سنگ‌نوردی" required>
        </div>

        <div class="mb-3">
            <label class="form-label">منطقه</label>
            <input type="text" name="area" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">نام قله (اختیاری)</label>
            <input type="text" name="peak_name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">ارتفاع قله (متر)</label>
            <input type="number" name="peak_height" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">مدت برنامه</label>
            <input type="text" name="duration" class="form-control" placeholder="مثلاً یک روزه">
        </div>

        <div class="mb-3">
            <label class="form-label">آدرس فایل گزارش (PDF)</label>
            <input type="text" name="pdf_path" class="form-control" placeholder="مثلاً reports/my-report.pdf">
        </div>

        <div class="mb-3">
            <label class="form-label">آدرس ترک مسیر (درصورت وجود)</label>
            <input type="url" name="track_url" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">تعداد شرکت‌کنندگان</label>
            <input type="number" name="participant_count" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">تصویر شاخص (نام فایل)</label>
            <input type="text" name="cover_image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">متن کامل گزارش</label>
            <textarea name="full_report" class="form-control" rows="6" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">ثبت گزارش</button>
    </form>
</div>
@endsection
