
@extends('layouts.admin')

@section('content')

{{-- سطر اول: اسلایدشو + عنوان و توضیحات --}}
<div class="row mb-5">
    <div class="col-md-6">
        @if($program->photos && $program->photos->count())
            <div id="programCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($program->photos as $index => $photo)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $photo->path) }}" class="d-block w-100 rounded" alt="photo">
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
        @else
            <div class="alert alert-warning">تصویری برای این برنامه موجود نیست.</div>
        @endif
    </div>
    <div class="col-md-6">
        <h3 class="mb-3">{{ $program->title }}</h3>
        <div class="text-justify">{!! $program->description !!}</div>
    </div>
</div>

{{-- سطر دوم: مسئولین + تجهیزات و وعده‌ها --}}
<div class="row mb-5">
    <div class="col-md-6">
        <h5 class="mb-3">🔰 مسئولین برنامه</h5>
        <div class="row">
        @foreach ($program->roles ?? [] as $role)
        <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <img src="{{ $role->user && $role->user->photo ? asset('storage/' . $role->user->photo) : asset('images/default-profile.png') }}" class="card-img-top" alt="profile">
                        <div class="card-body text-center">
                            <h6 class="card-title">{{ $role->role_title }}</h6>
                            <p class="card-text">
                                @if($role->user)
                                    {{ $role->user->name }}
                                @elseif($role->user_name)
                                    {{ $role->user_name }}
                                @else
                                    <span class="text-muted">تعریف نشده</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-6">
        <h5 class="mb-3">🎒 تجهیزات و وعده‌ها</h5>
        <ul class="list-group mb-3">
            <li class="list-group-item active">تجهیزات موردنیاز</li>
            @foreach(explode(',', $program->required_equipment) as $item)
                <li class="list-group-item">{{ $item }}</li>
            @endforeach
        </ul>
        <ul class="list-group">
            <li class="list-group-item active">وعده‌های ضروری</li>
            @foreach(explode(',', $program->required_meals) as $item)
                <li class="list-group-item">{{ $item }}</li>
            @endforeach
        </ul>
    </div>
</div>

{{-- سطر سوم: حمل و نقل --}}
@if(!$program->has_transport)
    <div class="alert alert-info">🚫 برنامه فاقد حمل‌ونقل است. حضور در محل برنامه به عهده اعضا و مهمانان می‌باشد.</div>
@else
    <div class="row mb-5">
        <div class="col-md-6">
            <h5 class="mb-2">🚌 حرکت از تهران</h5>
            <p><i class="bi bi-calendar-week"></i> {{ $program->departure_tehran_datetime }}</p>
            <p><i class="bi bi-geo-alt"></i> {{ $program->departure_place_tehran }}</p>
            <div id="map_tehran" style="height: 200px;" class="rounded border"></div>
        </div>
        <div class="col-md-6">
            <h5 class="mb-2">🚌 حرکت از کرج</h5>
            <p><i class="bi bi-calendar-week"></i> {{ $program->departure_karaj_datetime }}</p>
            <p><i class="bi bi-geo-alt"></i> {{ $program->departure_place_karaj }}</p>
            <div id="map_karaj" style="height: 200px;" class="rounded border"></div>
        </div>
    </div>
@endif

{{-- سطر چهارم: هزینه‌ها --}}
@if($program->is_free)
    <div class="alert alert-success">🎁 این برنامه رایگان است.</div>
@else
    <div class="row mb-5">
        <div class="col-md-6">
            <h5>💳 هزینه اعضا</h5>
            <p>{{ number_format($program->member_cost) }} ریال</p>
        </div>
        <div class="col-md-6">
            <h5>💳 هزینه مهمان</h5>
            <p>{{ number_format($program->guest_cost) }} ریال</p>
        </div>
    </div>
@endif

{{-- سطر پنجم: اطلاعات پرداخت --}}
<div class="card mb-5">
    <div class="card-header bg-light">🏦 اطلاعات کارت بانکی</div>
    <div class="card-body">
        <p><strong>شماره کارت:</strong> {{ $program->card_number }}</p>
        <p><strong>شماره شبا:</strong> {{ $program->sheba_number }}</p>
        <p><strong>نام دارنده کارت:</strong> {{ $program->card_holder }}</p>
        <p><strong>نام بانک:</strong> {{ $program->bank_name }}</p>
    </div>
</div>

{{-- سطر ششم: مهلت ثبت‌نام --}}
<div class="text-center">
    <h5><i class="bi bi-calendar-event"></i> مهلت ثبت‌نام: {{ $program->registration_deadline }}</h5>
</div>


@push('scripts')
<script>
    function initMap(divId, lat, lon) {
        const map = L.map(divId).setView([lat, lon], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        L.marker([lat, lon]).addTo(map);
    }

    // این دوتا خط حتما باید اجرا بشن
    initMap('map_tehran', {{ $program->departure_lat_tehran }}, {{ $program->departure_lon_tehran }});
    initMap('map_karaj', {{ $program->departure_lat_karaj }}, {{ $program->departure_lon_karaj }});
</script>
@endpush
@endsection
