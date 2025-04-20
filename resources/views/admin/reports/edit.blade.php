@extends('layout')

@section('title', 'ویرایش گزارش')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">ویرایش گزارش برنامه</h2>

    <form action="{{ route('admin.reports.update', $report) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">عنوان گزارش</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $report->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">تاریخ اجرا</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $report->date) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">نوع برنامه</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $report->type) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">منطقه</label>
            <input type="text" name="area" class="form-control" value="{{ old('area', $report->area) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">نام قله</label>
            <input type="text" name="peak_name" class="form-control" value="{{ old('peak_name', $report->peak_name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">ارتفاع قله</label>
            <input type="number" name="peak_height" class="form-control" value="{{ old('peak_height', $report->peak_height) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">مدت برنامه</label>
            <input type="text" name="duration" class="form-control" value="{{ old('duration', $report->duration) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">تعداد شرکت‌کنندگان</label>
            <input type="number" name="participant_count" class="form-control" value="{{ old('participant_count', $report->participant_count) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">آدرس فایل PDF گزارش</label>
            <input type="text" name="pdf_path" class="form-control" value="{{ old('pdf_path', $report->pdf_path) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">لینک ترک مسیر</label>
            <input type="url" name="track_url" class="form-control" value="{{ old('track_url', $report->track_url) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">تصویر شاخص (نام فایل)</label>
            <input type="text" name="cover_image" class="form-control" value="{{ old('cover_image', $report->cover_image) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">متن کامل گزارش</label>
            <textarea name="full_report" class="form-control" rows="6" required>{{ old('full_report', $report->full_report) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">ذخیره تغییرات</button>
    </form>
</div>
@endsection
