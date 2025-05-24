@extends('dashboard.layout')

@section('title', 'گزارش‌های من')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">گزارش‌های نوشته‌شده توسط شما</h3>

    @if($reports->isEmpty())
        <div class="alert alert-info">شما تاکنون گزارشی ارسال نکرده‌اید.</div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>عنوان گزارش</th>
                    <th>مربوط به برنامه</th>
                    <th>وضعیت</th>
                    <th>تاریخ ارسال</th>
                    <th>مشاهده</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->title }}</td>
                        <td>{{ optional($report->program)->title ?? '—' }}</td>
                        <td>
                            @if($report->approved)
                                <span class="badge bg-success">تایید شده</span>
                            @else
                                <span class="badge bg-warning text-dark">در انتظار تایید</span>
                            @endif
                        </td>
                        <td>{{ jdate($report->created_at)->format('Y/m/d') }}</td>
                        <td>
                            <a href="{{ route('dashboard.reports.show', $report->id) }}" class="btn btn-sm btn-outline-primary">مشاهده</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
