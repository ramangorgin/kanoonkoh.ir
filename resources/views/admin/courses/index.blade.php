@extends('admin.layout')

@section('content')
<h4 class="mb-4">دوره‌ها</h4>

<a href="{{ route('admin.courses.create') }}" class="btn btn-success btn-sm mb-3">ایجاد دوره جدید</a>

@if($courses->isEmpty())
    <div class="alert alert-warning">هیچ دوره‌ای ثبت نشده است.</div>
@else
<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>عنوان</th>
            <th>مدرس</th>
            <th>تاریخ</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->instructor }}</td>
                <td>{{ jdate($course->start_date)->format('Y/m/d') }}</td>
                <td>{{ $course->status }}</td>
                <td>
                    <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-sm btn-secondary">نمایش</a>
                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-primary">ویرایش</a>
                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('آیا مطمئنی؟')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $courses->links() }}
@endif
@endsection
