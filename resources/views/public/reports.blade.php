@extends('layouts.app')

@section('title', 'گزارش‌ها')

@section('content')
<h2 class="mb-4">گزارش‌های کانون کوه</h2>

<div class="row">
    @forelse($reports as $report)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($report->cover_image)
                    <img src="{{ asset('storage/' . $report->cover_image) }}" class="card-img-top" alt="{{ $report->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $report->title }}</h5>
                    <p class="card-text text-muted">تاریخ اجرا: {{ jdate($report->execution_date)->format('Y/m/d') }}</p>
                    <a href="{{ route('public.reports.show', $report->id) }}" class="btn btn-outline-primary btn-sm">جزئیات</a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">هیچ گزارش‌ای پیدا نشد.</p>
    @endforelse
</div>

{{ $reports->links() }}
@endsection
