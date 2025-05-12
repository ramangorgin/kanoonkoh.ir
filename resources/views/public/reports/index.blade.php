@extends('layouts.app')

@section('title', 'آرشیو گزارش‌ها')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-center fw-bold">آرشیو گزارش‌های برنامه‌ها</h2>

    @if($reports->isEmpty())
        <div class="alert alert-info text-center">هیچ گزارشی ثبت نشده است.</div>
    @else
        <div class="row">
            @foreach($reports as $report)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if($report->cover_image)
                            <img src="{{ asset('storage/' . $report->cover_image) }}" class="card-img-top" alt="کاور گزارش" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $report->title }}</h5>
                            <p class="card-text small text-muted mb-1">منطقه: {{ $report->area }}</p>
                            <p class="card-text small text-muted mb-1">تاریخ اجرا: {{ jdate($report->start_date)->format('Y/m/d') }}</p>
                            <p class="card-text small text-muted">نوع برنامه: {{ $report->type }}</p>
                            <a href="{{ route('public.reports.show', $report->id) }}" class="btn btn-outline-primary mt-auto">مشاهده گزارش</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $reports->links() }}
        </div>
    @endif

</div>
@endsection
