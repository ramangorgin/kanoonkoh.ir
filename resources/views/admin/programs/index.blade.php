@extends('layout')

@section('title', 'مدیریت برنامه‌ها')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">مدیریت برنامه‌ها</h2>

    <a href="{{ route('admin.programs.create') }}" class="btn btn-success mb-3">برنامه جدید</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>عنوان</th>
                <th>تاریخ اجرا</th>
                <th>نوع</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
                <tr>
                    <td>{{ $program->title }}</td>
                    <td>{{ jdate($program->execution_date)->format('Y/m/d') }}</td>
                    <td>{{ $program->type }}</td>
                    <td>{{ $program->status }}</td>
                    <td>
                        <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-warning btn-sm">ویرایش</a>
                        <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('حذف شود؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
