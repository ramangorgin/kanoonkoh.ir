@extends('layout')

@section('title', 'افزودن دوره جدید')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">افزودن دوره جدید</h2>

    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">عنوان دوره</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">توضیحات</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">تاریخ برگزاری</label>
            <input type="date" name="event_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="event_time" class="form-label">ساعت برگزاری</label>
            <input type="text" name="event_time" class="form-control" placeholder="مثلاً: 16 تا 19" required>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">ظرفیت</label>
            <input type="number" name="capacity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">هزینه (تومان)</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">مدرک دارد؟</label>
            <select name="has_certificate" class="form-select">
                <option value="1">دارد</option>
                <option value="0">ندارد</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="poster" class="form-label">پوستر دوره (نام فایل در storage)</label>
            <input type="text" name="poster" class="form-control" placeholder="مثلاً course1.jpg">
        </div>

        <button type="submit" class="btn btn-primary w-100">ثبت دوره</button>
    </form>
</div>
@endsection
