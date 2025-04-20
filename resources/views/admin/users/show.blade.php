@extends('layout')

@section('title', 'مشخصات کاربر')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">اطلاعات {{ $user->first_name }} {{ $user->last_name }}</h3>

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>ایمیل:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>کد ملی:</strong> {{ $user->national_id }}</li>
        <li class="list-group-item"><strong>شماره تماس:</strong> {{ $user->phone_number }}</li>
        <li class="list-group-item"><strong>وضعیت عضویت:</strong> {{ $user->membership_type }}</li>
    </ul>

    <h5>برنامه‌های ثبت‌نام‌شده:</h5>
    <ul class="list-group mb-4">
        @foreach($user->programRegistrations as $reg)
            <li class="list-group-item">{{ $reg->program->title }} (کد رهگیری: {{ $reg->reference_id }})</li>
        @endforeach
    </ul>

    <h5>دوره‌های ثبت‌نام‌شده:</h5>
    <ul class="list-group mb-4">
        @foreach($user->courseRegistrations as $reg)
            <li class="list-group-item">{{ $reg->course->title }} (کد رهگیری: {{ $reg->reference_id }})</li>
        @endforeach
    </ul>

    <h5>گزارش‌های نوشته‌شده:</h5>
    <ul class="list-group">
        @foreach($user->reports as $report)
            <li class="list-group-item">{{ $report->title }}</li>
        @endforeach
    </ul>
</div>
@endsection
