@extends('admin.layout')

@section('content')
<h4 class="mb-4">گزارش‌ها</h4>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>عنوان</th>
            <th>برنامه</th>
            <th>کاربر</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->title }}</td>
                <td>{{ optional($report->program)->title }}</td>
                <td>{{ optional($report->user)->first_name }}</td>
                <td>{{ $report->status }}</td>
                <td>
                    <a href="{{ route('admin.reports.show', $report) }}" class="btn btn-sm btn-secondary">نمایش</a>
                    <a href="{{ route('admin.reports.edit', $report) }}" class="btn btn-sm btn-primary">تایید/رد</a>
                    <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" class="d-inline" onsubmit="return confirm('مطمئنی؟')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $reports->links() }}
@endsection
