@extends('admin.layout')

@section('content')
<h4 class="mb-3">مشاهده گزارش: {{ $report->title }}</h4>

<table class="table table-bordered">
    <tr><th>برنامه</th><td>{{ optional($report->program)->title }}</td></tr>
    <tr><th>کاربر</th><td>{{ optional($report->user)->first_name }}</td></tr>
    <tr><th>محتوا</th><td>{{ $report->content }}</td></tr>
    <tr><th>وضعیت</th><td>{{ $report->status }}</td></tr>
    @if($report->photos)
        <tr>
            <th>تصاویر</th>
            <td>
                @foreach(json_decode($report->photos) as $photo)
                    <img src="{{ asset('storage/' . $photo) }}" width="150" class="m-1">
                @endforeach
            </td>
        </tr>
    @endif
</table>

<a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">بازگشت</a>
@endsection
