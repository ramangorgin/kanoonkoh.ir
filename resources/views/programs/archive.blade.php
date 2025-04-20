@extends('layout')

@section('title', 'آرشیو برنامه‌ها')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">آرشیو برنامه‌ها</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($programs as $program)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $program->cover_image) }}" class="card-img-top" alt="{{ $program->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $program->title }}</h5>
                        <p class="card-text">{{ Str::limit(strip_tags($program->description), 100) }}</p>
                        <a href="{{ route('programs.show', $program) }}" class="btn btn-outline-primary">مشاهده</a>
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
