@extends('layout')

@section('title', 'لیست برنامه‌ها')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">برنامه‌های کانون کوه</h2>

    <div class="row g-4">
        @foreach($programs as $program)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $program->cover_image) }}" class="card-img-top" alt="{{ $program->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $program->title }}</h5>
                        <p class="card-text">{{ Str::limit($program->description, 100) }}</p>
                        <a href="{{ route('programs.show', $program->id) }}" class="btn btn-primary">مشاهده جزئیات</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $programs->links() }}
    </div>
</div>
@endsection
