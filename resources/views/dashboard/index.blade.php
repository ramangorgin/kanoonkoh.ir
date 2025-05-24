{{-- resources/views/dashboard/index.blade.php --}}
@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">داشبورد کاربری</h2>

    <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">مشخصات من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="insurance-tab" data-bs-toggle="tab" data-bs-target="#insurance" type="button" role="tab">بیمه ورزشی من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="membership-tab" data-bs-toggle="tab" data-bs-target="#membership" type="button" role="tab">حق‌عضویت‌های من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="programs-tab" data-bs-toggle="tab" data-bs-target="#programs" type="button" role="tab">برنامه‌های من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses" type="button" role="tab">دوره‌های من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab">گزارش‌های من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets" type="button" role="tab">تیکت‌های من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">تنظیمات</button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="dashboardTabsContent">
        <div class="tab-pane fade show active" id="profile" role="tabpanel">@include('dashboard.profile')</div>
        <div class="tab-pane fade" id="insurance" role="tabpanel">@include('dashboard.insurance')</div>
        <div class="tab-pane fade" id="membership" role="tabpanel">@include('dashboard.membership')</div>
        <div class="tab-pane fade" id="programs" role="tabpanel">@include('dashboard.programs')</div>
        <div class="tab-pane fade" id="courses" role="tabpanel">@include('dashboard.courses')</div>
        <div class="tab-pane fade" id="reports" role="tabpanel">@include('dashboard.reports.index')</div>
        <div class="tab-pane fade" id="tickets" role="tabpanel">@include('dashboard.tickets')</div>
        <div class="tab-pane fade" id="settings" role="tabpanel">@include('dashboard.settings')</div>
    </div>
</div>
@endsection
