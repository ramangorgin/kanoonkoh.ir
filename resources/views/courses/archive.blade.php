@extends('layout')

@section('title', 'آرشیو دوره‌ها')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">آرشیو دوره‌ها</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($courses as $course)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $course->cover_image) }}" class="card-img-top" alt="{{ $course->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit(strip_tags($course->description), 100) }}</p>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary">مشاهده</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</div>
@endsection
