@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-bold mb-4">پنل کاربری {{ auth()->user()->first_name }}</h2>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                type="button" role="tab">تکمیل مشخصات فردی</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="programs-tab" data-bs-toggle="tab" data-bs-target="#programs"
                type="button" role="tab">برنامه‌های من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses"
                type="button" role="tab">دوره‌های من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports"
                type="button" role="tab">گزارش‌های من</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments"
                type="button" role="tab">پرداخت‌ها</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets"
                type="button" role="tab">تیکت‌ها</button>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content mt-4" id="dashboardTabsContent">

        <div class="tab-pane fade show active" id="profile" role="tabpanel">
            @include('dashboard.partials.profile-form')
        </div>

        <div class="tab-pane fade" id="programs" role="tabpanel">
            @include('dashboard.tabs.my-programs')
        </div>

        <div class="tab-pane fade" id="courses" role="tabpanel">
            @include('dashboard.tabs.my-courses')
        </div>

        <div class="tab-pane fade" id="reports" role="tabpanel">
            @include('dashboard.tabs.reports')
        </div>

        <div class="tab-pane fade" id="payments" role="tabpanel">
            @include('dashboard.tabs.payments')
        </div>

        <div class="tab-pane fade" id="tickets" role="tabpanel">
            @include('dashboard.tabs.tickets')
        </div>

    </div>
</div>
@endsection
