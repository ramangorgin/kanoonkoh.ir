@extends('layout')

@section('title', 'مدیریت گزارش‌ها')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">لیست گزارش‌ها</h2>

    <a href="{{ route('admin.reports.create') }}" class="btn btn-success mb-3">افزودن گزارش جدید</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>عنوان</th>
                <th>تاریخ</th>
                <th>نوع</th>
                <th>منطقه</th>
                <th>نویسنده</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->title }}</td>
                    <td>{{ jdate($report->date)->format('Y/m/d') }}</td>
                    <td>{{ $report->type }}</td>
                    <td>{{ $report->area }}</td>
                    <td>{{ $report->author_id }}</td>
                    <td>
                        <a href="{{ route('admin.reports.edit', $report) }}" class="btn btn-warning btn-sm">ویرایش</a>
                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('حذف شود؟')" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
