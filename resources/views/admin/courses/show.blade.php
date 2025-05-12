@extends('admin.layout')

@section('content')
<h4 class="mb-4">مشاهده دوره: {{ $course->title }}</h4>

<table class="table table-bordered">
    <tr><th>عنوان</th><td>{{ $course->title }}</td></tr>
    <tr><th>مدرس</th><td>{{ $course->instructor }}</td></tr>
    <tr><th>تاریخ</th><td>{{ jdate($course->start_date)->format('Y/m/d') }} تا {{ jdate($course->end_date)->format('Y/m/d') }}</td></tr>
    <tr><th>ساعت</th><td>{{ $course->start_time }} - {{ $course->end_time }}</td></tr>
    <tr><th>مکان</th><td>{{ $course->location_name }}</td></tr>
    <tr><th>هزینه اعضا</th><td>{{ number_format($course->member_cost) }}</td></tr>
    <tr><th>هزینه مهمان</th><td>{{ number_format($course->guest_cost) }}</td></tr>
    <tr><th>پیش‌نیاز</th><td>{{ $course->requirements }}</td></tr>
    <tr><th>توضیحات</th><td>{{ $course->notes_for_participants }}</td></tr>
    <tr>
        <th>تصویر</th>
        <td>
            @if($course->cover_image)
                <img src="{{ asset('storage/' . $course->cover_image) }}" width="200">
            @else
                <span class="text-muted">ندارد</span>
            @endif
        </td>
    </tr>
</table>

<a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">بازگشت</a>
@endsection
