@extends('layout')

@section('title', 'آرشیو گزارش‌ها')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">آرشیو گزارش‌ها</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($reports as $report)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $report->cover_image) }}" class="card-img-top" alt="{{ $report->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $report->title }}</h5>
                        <p class="card-text">{{ Str::limit(strip_tags($report->description), 100) }}</p>
                        <a href="{{ route('reports.show', $report) }}" class="btn btn-outline-primary">مشاهده</a>
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
