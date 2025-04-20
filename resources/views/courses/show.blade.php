@extends('layout')

@section('title', $course->title)

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $course->title }}</h2>

    <img src="{{ asset('storage/' . $course->poster) }}" class="img-fluid mb-4 rounded">

    <p><strong>توضیحات:</strong></p>
    <p>{{ $course->description }}</p>

    <p><strong>تاریخ برگزاری:</strong> {{ jdate($course->event_date)->format('Y/m/d') }}</p>
    <p><strong>ساعت:</strong> {{ $course->event_time }}</p>
    <p><strong>ظرفیت:</strong> {{ $course->capacity }} نفر</p>
    <p><strong>هزینه:</strong> {{ number_format($course->price) }} تومان</p>
    <p><strong>مدرک دارد؟</strong> {{ $course->has_certificate ? 'بله' : 'خیر' }}</p>
</div>

<h4 class="mt-5">فرم ثبت‌نام در دوره</h4>

<form action="{{ route('courses.register', $course) }}" method="POST" class="border p-4 bg-light rounded">
    @csrf

    @guest
        <div class="mb-3">
            <label class="form-label">نام و نام خانوادگی</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">کد ملی</label>
            <input type="text" name="national_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">شماره تماس</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">شماره اضطراری</label>
            <input type="text" name="emergency_phone" class="form-control" required>
        </div>
    @endguest

    <div class="mb-3">
        <label class="form-label">کد رهگیری پرداخت</label>
        <input type="text" name="reference_id" class="form-control" required>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="agreement" value="1" id="agree" required>
        <label class="form-check-label" for="agree">
            قوانین و مقررات دوره را مطالعه کرده‌ام و متعهد به رعایت آن‌ها هستم.
        </label>
    </div>

    <button class="btn btn-success w-100">ثبت‌نام</button>
</form>

@endsection
