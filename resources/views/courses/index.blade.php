@extends('layout')

@section('title', 'دوره‌ها')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">دوره‌های کانون کوه</h2>

    <div class="row g-4">
        @foreach($courses as $course)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $course->poster) }}" class="card-img-top" alt="{{ $course->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">جزئیات</a>
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
