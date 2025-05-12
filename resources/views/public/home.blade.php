@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">خوش آمدید به باشگاه کانون کوه</h2>

    <h4>برنامه‌های اخیر</h4>
    <ul>
        @foreach($programs as $program)
            <li>{{ $program->title }} - {{ jdate($program->execution_date)->format('Y/m/d') }}</li>
        @endforeach
    </ul>

    <h4 class="mt-4">دوره‌های اخیر</h4>
    <ul>
        @foreach($courses as $course)
            <li>{{ $course->title }} - {{ jdate($course->start_date)->format('Y/m/d') }}</li>
        @endforeach
    </ul>

    <h4 class="mt-4">آخرین گزارش‌ها</h4>
    <ul>
        @foreach($reports as $report)
            <li>{{ $report->title }}</li>
        @endforeach
    </ul>
</div>
@endsection
