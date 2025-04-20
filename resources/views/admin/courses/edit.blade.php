@extends('layout')

@section('title', 'ویرایش دوره')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">ویرایش دوره</h2>

    <form action="{{ route('admin.courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">عنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">توضیحات</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $course->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">تاریخ برگزاری</label>
            <input type="date" name="event_date" class="form-control" value="{{ old('event_date', $course->event_date) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ساعت برگزاری</label>
            <input type="text" name="event_time" class="form-control" value="{{ old('event_time', $course->event_time) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ظرفیت</label>
            <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $course->capacity) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">هزینه (تومان)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $course->price) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">مدرک دارد؟</label>
            <select name="has_certificate" class="form-select">
                <option value="1" @selected($course->has_certificate)>دارد</option>
                <option value="0" @selected(!$course->has_certificate)>ندارد</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">پوستر دوره (نام فایل)</label>
            <input type="text" name="poster" class="form-control" value="{{ old('poster', $course->poster) }}">
        </div>

        <button type="submit" class="btn btn-primary w-100">ذخیره تغییرات</button>
    </form>
</div>
@endsection
