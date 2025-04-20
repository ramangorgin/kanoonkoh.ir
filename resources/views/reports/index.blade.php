@extends('layout')

@section('title', 'گزارش برنامه‌ها')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">گزارش برنامه‌های اجراشده</h2>

    <div class="row g-4">
        @foreach($reports as $report)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $report->cover_image) }}" class="card-img-top" alt="{{ $report->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $report->title }}</h5>
                        <p class="card-text">{{ Str::limit($report->full_report, 100) }}</p>
                        <a href="{{ route('reports.show', $report->id) }}" class="btn btn-primary">مطالعه گزارش</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $reports->links() }}
    </div>
</div>
@endsection
