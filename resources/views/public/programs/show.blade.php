@extends('layouts.app')

@section('title', $program->title)

@section('content')
<div class="container">

    {{-- عنوان برنامه --}}
    <h2 class="mb-4">{{ $program->title }}</h2>

    {{-- اسلایدر عکس‌ها --}}
    @if($program->report_photos)
        @php $photos = json_decode($program->report_photos, true); @endphp
        <div id="programCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($photos as $index => $photo)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $photo) }}" class="d-block w-100 rounded" alt="عکس {{ $index + 1 }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#programCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#programCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    @endif

    {{-- توضیحات برنامه --}}
    <div class="mb-4">
        <h5>توضیحات برنامه:</h5>
        <p>{{ $program->description }}</p>
    </div>

    {{-- مسئولین برنامه --}}
    <div class="mb-4">
        <h5>مسئولین برنامه:</h5>
        <div class="row">
            @foreach([
                'leader' => 'سرپرست',
                'assistant_leader' => 'کمک‌سرپرست',
                'technical_manager' => 'مسئول فنی',
                'guide' => 'راهنما',
                'support' => 'پشتیبان'
            ] as $key => $role)
                @php $user = $program->{$key}; @endphp
                @if($user)
                <div class="col-md-2 text-center">
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" class="rounded-circle mb-2" width="80" height="80">
                    <div class="fw-bold">{{ $user->first_name }} {{ $user->last_name }}</div>
                    <div class="text-muted small">{{ $role }}</div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- جزئیات حرکت از تهران و کرج --}}
    @foreach(['tehran', 'karaj'] as $city)
        @php
            $lat = $program->{'departure_lat_' . $city};
            $lon = $program->{'departure_lon_' . $city};
        @endphp
        @if($lat && $lon)
        <div class="mb-4">
            <h5>حرکت از {{ $city == 'tehran' ? 'تهران' : 'کرج' }}</h5>
            <p>
                تاریخ: {{ jdate($program->{'departure_date_' . $city})->format('Y/m/d') }} <br>
                ساعت: {{ $program->{'departure_time_' . $city} }} <br>
                محل: {{ $program->{'departure_place_' . $city} }}
            </p>
            <div id="map-{{ $city }}" style="height: 300px;" class="mb-3 rounded border"></div>
        </div>
        @endif
    @endforeach

    {{-- تجهیزات و وعده‌های غذایی --}}
    <div class="mb-4">
        <h5>تجهیزات مورد نیاز:</h5>
        <p>{{ $program->required_equipment }}</p>

        <h5>وعده‌های غذایی مورد نیاز:</h5>
        <p>{{ $program->required_meals }}</p>
    </div>

    {{-- هزینه‌ها و اطلاعات بانکی --}}
    @if(!$program->is_free)
        <div class="mb-4">
            <h5>هزینه ثبت‌نام:</h5>
            <p>برای اعضا: {{ number_format($program->member_cost) }} تومان</p>
            <p>برای مهمانان: {{ number_format($program->guest_cost) }} تومان</p>

            <h6 class="mt-3">اطلاعات واریز:</h6>
            <p>
                شماره کارت: {{ $program->card_number }} <br>
                شبا: {{ $program->sheba_number }} <br>
                صاحب کارت: {{ $program->card_holder }} ({{ $program->bank_name }})
            </p>
        </div>
    @endif

    {{-- فرم ثبت‌نام --}}
    @if($program->is_registration_open && $program->registration_deadline > now())
        <div class="mb-5">
            <h4 class="mb-3">فرم ثبت‌نام در برنامه</h4>

            <form action="{{ route('user.programs.register', $program->id) }}" method="POST">
                @csrf

                @guest
                    {{-- فیلد مهمان --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>نام و نام خانوادگی</label>
                            <input type="text" name="guest_name" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>شماره تلفن</label>
                            <input type="text" name="guest_phone" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>کد ملی</label>
                            <input type="text" name="guest_national_id" class="form-control" required>
                        </div>
                    </div>
                @endguest

                @if($program->has_transport)
                    <div class="mb-3">
                        <label>محل سوار شدن</label>
                        <select name="pickup_location" class="form-select" required>
                            <option value="تهران">تهران</option>
                            <option value="کرج">کرج</option>
                        </select>
                    </div>
                @endif

                @if(!$program->is_free)
                    <div class="mb-3">
                        <label>کد پیگیری تراکنش پرداخت</label>
                        <input type="text" name="transaction_code" class="form-control" required>
                    </div>
                @endif

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="agree" required>
                    <label class="form-check-label">
                        با <a href="{{ route('rules') }}" target="_blank">قوانین و مقررات</a> موافقم.
                    </label>
                </div>

                <button type="submit" class="btn btn-success">ثبت‌نام</button>
            </form>
        </div>
    @else
        <div class="alert alert-warning text-center">
            ثبت‌نام برای این برنامه بسته شده است.
        </div>
    @endif

</div>
@endsection

@push('scripts')
    {{-- OpenStreetMap Script --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        @foreach(['tehran', 'karaj'] as $city)
            @if($program->{'departure_lat_' . $city})
                const map_{{ $city }} = L.map('map-{{ $city }}').setView([{{ $program->{'departure_lat_' . $city} }}, {{ $program->{'departure_lon_' . $city} }}], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19
                }).addTo(map_{{ $city }});
                L.marker([{{ $program->{'departure_lat_' . $city} }}, {{ $program->{'departure_lon_' . $city} }}]).addTo(map_{{ $city }});
            @endif
        @endforeach
    </script>
@endpush
