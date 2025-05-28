@extends('layouts.dashboard')

@section('title', 'ارسال تیکت جدید')

@section('breadcrumb')
    <a href="{{ route('dashboard.index') }}">داشبورد</a> /
    <a href="{{ route('dashboard.reports.index') }}">تیکت‌ها</a> /
    <span>ارسال تیکت جدید</span>
@endsection

@section('content')
<div class="container my-5">
    <h3 class="mb-4">ارسال تیکت جدید</h3>

    <form method="POST" action="{{ route('dashboard.tickets.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">موضوع</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">متن پیام</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">ارسال تیکت</button>
    </form>
</div>
@endsection
