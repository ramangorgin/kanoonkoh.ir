@extends('layouts.app')

@section('title', 'دوره‌ها')

@section('content')
<h2 class="mb-4">دوره‌های کانون کوه</h2>

<div class="row">
    @forelse($courses as $course)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($course->cover_image)
                    <img src="{{ asset('storage/' . $course->cover_image) }}" class="card-img-top" alt="{{ $course->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text text-muted">تاریخ اجرا: {{ jdate($course->execution_date)->format('Y/m/d') }}</p>
                    <a href="{{ route('public.courses.show', $course->id) }}" class="btn btn-outline-primary btn-sm">جزئیات | ثبت‌نام</a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">هیچ دوره‌ای پیدا نشد.</p>
    @endforelse
</div>

{{ $courses->links() }}
@endsection
