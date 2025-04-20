@extends('layout')

@section('title', 'مدیریت دوره‌ها')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">لیست دوره‌ها</h2>

    <a href="{{ route('admin.courses.create') }}" class="btn btn-success mb-3">افزودن دوره جدید</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>عنوان</th>
                <th>تاریخ</th>
                <th>ساعت</th>
                <th>ظرفیت</th>
                <th>مدرک</th>
                <th>هزینه</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ jdate($course->event_date)->format('Y/m/d') }}</td>
                    <td>{{ $course->event_time }}</td>
                    <td>{{ $course->capacity }}</td>
                    <td>{{ $course->has_certificate ? 'دارد' : 'ندارد' }}</td>
                    <td>{{ number_format($course->price) }} تومان</td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-warning">ویرایش</a>
                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('آیا مطمئن هستید؟')" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
