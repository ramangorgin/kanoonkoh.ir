@extends('layouts.dashboard')

@section('title', 'برنامه‌های من')

@section('breadcrumb')
    <a href="{{ route('dashboard.index') }}">داشبورد</a> / <span>برنامه‌های من</span>
@endsection

@section('content')

<h5 class="mb-3">برنامه‌های من</h5>
{{-- بررسی ایمن برای اطمینان از وجود و شمارش‌پذیر بودن $programs --}}
@if(isset($programs) && count($programs))
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>عنوان</th>
                    <th>تاریخ شروع</th>
                    <th>تاریخ پایان</th>
                    <th>توضیحات</th>
                    <th>لینک/ثبت‌نام</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                    <tr>
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->start_date }}</td>
                        <td>{{ $program->end_date }}</td>
                        <td>{{ $program->description }}</td>
                        <td><a href="{{ route('programs.show', $program) }}">مشاهده</a></td>
                        <td>...</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-warning">
شما هنوز در هیچ برنامه‌ای شرکت نکرده‌اید.     
    </div>
@endif
@endsection