@extends('layout')

@section('title', 'پنل کاربری')

@section('content')

@if(auth()->user()->is_admin)
    <div class="alert alert-info">شما به عنوان مدیر وارد شده‌اید</div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">رفتن به پنل مدیریت</a>
@else
    <div class="alert alert-success">خوش آمدید {{ auth()->user()->first_name }}</div>
@endif

<div class="container py-5">
    <h2 class="mb-4">پنل کاربری {{ auth()->user()->first_name }}</h2>

    <ul class="nav nav-pills mb-4" id="userPanelTabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="pill" href="#profile">پروفایل</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#insurance">بیمه ورزشی</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#membership">پرداخت عضویت</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#programs">برنامه‌های من</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#courses">دوره‌های من</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#reports">گزارش‌های من</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tickets">تیکت‌ها</a></li>
    </ul>

    <div class="tab-content border rounded p-4 bg-light">
        <div class="tab-pane fade show active" id="profile">@include('user.partials.profile')</div>
        <div class="tab-pane fade" id="insurance">@include('user.partials.insurance')</div>
        <div class="tab-pane fade" id="membership">@include('user.partials.membership')</div>
        <div class="tab-pane fade" id="programs">@include('user.partials.programs')</div>
        <div class="tab-pane fade" id="courses">@include('user.partials.courses')</div>
        <div class="tab-pane fade" id="reports">@include('user.partials.reports')</div>
        <div class="tab-pane fade" id="tickets">@include('user.partials.tickets')</div>
    </div>
</div>
@endsection
