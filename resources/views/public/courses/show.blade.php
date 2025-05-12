@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="container">
    {{-- عنوان دوره و عکس کاور --}}
    <div class="mb-4 text-center">
        <h2 class="fw-bold">{{ $course->title }}</h2>
        @if($course->cover_image)
            <img src="{{ asset('storage/' . $course->cover_image) }}" class="img-fluid rounded shadow mt-3" style="max-height: 300px;">
        @endif
    </div>

    {{-- مشخصات کلی دوره --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <strong>نوع دوره:</strong> {{ $course->type }}
        </div>
        <div class="col-md-4">
            <strong>مرجع برگزارکننده:</strong> {{ $course->provider }}
        </div>
        <div class="col-md-4">
            <strong>مدرس:</strong> {{ $course->instructor }}
        </div>
    </div>

    {{-- تاریخ و زمان دوره --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <strong>تاریخ شروع:</strong> {{ jdate($course->start_date)->format('Y/m/d') }}
        </div>
        <div class="col-md-4">
            <strong>تاریخ پایان:</strong> {{ jdate($course->end_date)->format('Y/m/d') }}
        </div>
        <div class="col-md-4">
            <strong>ساعت برگزاری:</strong> {{ $course->start_time }} الی {{ $course->end_time }}
        </div>
    </div>

    {{-- مکان برگزاری + نقشه --}}
    <div class="mb-4">
        <strong>مکان برگزاری:</strong> {{ $course->location_name }}
        @if($course->lat && $course->lon)
            <div id="course-map" class="mt-2 rounded" style="height: 300px;"></div>
        @endif
    </div>

    {{-- توضیحات و نکات --}}
    <div class="mb-4">
        <h5>توضیحات دوره:</h5>
        <p>{{ $course->description }}</p>
        @if($course->requirements)
            <h6 class="mt-3">پیش‌نیازها:</h6>
            <p>{{ $course->requirements }}</p>
        @endif
        @if($course->notes_for_participants)
            <h6>نکات برای شرکت‌کنندگان:</h6>
            <p>{{ $course->notes_for_participants }}</p>
        @endif
    </div>

    {{-- ظرفیت و وضعیت --}}
    <div class="mb-4">
        <strong>ظرفیت:</strong> {{ $course->capacity ? $course->capacity . ' نفر' : 'نامحدود' }} <br>
        <strong>وضعیت ثبت‌نام:</strong>
        @if($course->is_registration_open)
            <span class="badge bg-success">باز</span>
        @else
            <span class="badge bg-secondary">بسته</span>
        @endif
    </div>

    {{-- هزینه و اطلاعات واریز --}}
    @if(!$course->is_free)
    <div class="mb-4">
        <h5>هزینه ثبت‌نام:</h5>
        <p>اعضا: {{ number_format($course->member_cost) }} تومان</p>
        <p>مهمانان: {{ number_format($course->guest_cost) }} تومان</p>

        <h6>اطلاعات واریز:</h6>
        <p>
            شماره کارت: {{ $course->card_number }}<br>
            شبا: {{ $course->sheba_number }}<br>
            صاحب کارت: {{ $course->card_holder }} ({{ $course->bank_name }})
        </p>
    </div>
    @endif

    {{-- فرم ثبت‌نام --}}
    @if($course->is_registration_open && $course->end_date >= today())
        <div class="border-top pt-4 mt-4">
            <h4 class="mb-3">فرم ثبت‌نام در دوره</h4>
            <form action="{{ route('user.courses.register', $course->id) }}" method="POST">
                @csrf

                @guest
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>نام و نام خانوادگی</label>
                            <input type="text" name="guest_name" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>شماره تماس</label>
                            <input type="text" name="guest_phone" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>کد ملی</label>
                            <input type="text" name="guest_national_id" class="form-control" required>
                        </div>
                    </div>
                @endguest

                @if(!$course->is_free)
                    <div class="mb-3">
                        <label>کد پیگیری تراکنش</label>
                        <input type="text" name="transaction_code" class="form-control" required>
                    </div>
                @endif

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="agree" required>
                    <label class="form-check-label">
                        با <a href="{{ route('rules') }}" target="_blank">قوانین و مقررات</a> موافقم
                    </label>
                </div>

                <button type="submit" class="btn btn-success">ثبت‌نام</button>
            </form>
        </div>
    @else
        <div class="alert alert-warning text-center mt-4">
            ثبت‌نام در این دوره بسته شده است.
        </div>
    @endif
</div>
@endsection

@push('scripts')
    @if($course->lat && $course->lon)
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            const map = L.map('course-map').setView([{{ $course->lat }}, {{ $course->lon }}], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            L.marker([{{ $course->lat }}, {{ $course->lon }}]).addTo(map);
        </script>
    @endif
@endpush
