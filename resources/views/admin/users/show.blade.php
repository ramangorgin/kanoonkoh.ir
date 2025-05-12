@extends('admin.layout')

@section('content')
<h4 class="mb-3">پروفایل کاربر: {{ $user->first_name }} {{ $user->last_name }}</h4>

<table class="table table-bordered mb-4">
    <tr><th>ایمیل</th><td>{{ $user->email }}</td></tr>
    <tr><th>شماره موبایل</th><td>{{ $user->mobile }}</td></tr>
    <tr><th>استان</th><td>{{ $user->province }}</td></tr>
    <tr><th>نوع عضویت</th><td>{{ $user->membership_type }}</td></tr>
    <tr><th>تاریخ عضویت</th><td>{{ jdate($user->created_at)->format('Y/m/d') }}</td></tr>
</table>

<h5 class="mt-4">برنامه‌های شرکت‌کرده</h5>
<ul>
    @forelse($user->programs as $program)
        <li>{{ $program->title }}</li>
    @empty
        <li class="text-muted">هیچ برنامه‌ای ثبت نشده</li>
    @endforelse
</ul>

<h5 class="mt-4">دوره‌های گذرانده‌شده</h5>
<ul>
    @forelse($user->courses as $course)
        <li>{{ $course->title }}</li>
    @empty
        <li class="text-muted">هیچ دوره‌ای ثبت نشده</li>
    @endforelse
</ul>

<h5 class="mt-4">گزارش‌های نوشته‌شده</h5>
<ul>
    @forelse($user->reports as $report)
        <li>{{ $report->title }}</li>
    @empty
        <li class="text-muted">هیچ گزارشی ثبت نشده</li>
    @endforelse
</ul>

<a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">بازگشت</a>
@endsection
