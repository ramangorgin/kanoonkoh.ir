@extends('layouts.app')

@section('title', 'برنامه‌ها')

@section('content')
<h2 class="mb-4">برنامه‌های کانون کوه</h2>

<div class="row">
    @forelse($programs as $program)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($program->cover_image)
                    <img src="{{ asset('storage/' . $program->cover_image) }}" class="card-img-top" alt="{{ $program->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $program->title }}</h5>
                    <p class="card-text text-muted">تاریخ اجرا: {{ jdate($program->execution_date)->format('Y/m/d') }}</p>
                    <a href="{{ route('public.programs.show', $program->id) }}" class="btn btn-outline-primary btn-sm">جزئیات | ثبت‌نام</a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">هیچ برنامه‌ای پیدا نشد.</p>
    @endforelse
</div>

{{ $programs->links() }}
@endsection
