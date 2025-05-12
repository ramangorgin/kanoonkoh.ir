@extends('layouts.app')

@section('title', $report->title)

@section('content')
<div class="container py-4">

    {{-- عنوان گزارش --}}
    <h1 class="mb-4 text-center fw-bold">{{ $report->title }}</h1>

    {{-- اسلایدر تصاویر --}}
    @if ($report->gallery && is_array(json_decode($report->gallery, true)))
        <div id="reportGallery" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach (json_decode($report->gallery, true) as $index => $image)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 rounded" alt="تصویر {{ $index + 1 }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#reportGallery" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#reportGallery" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    @endif

    {{-- مشخصات کلی --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr><th>نوع برنامه</th><td>{{ $report->type }}</td></tr>
                <tr><th>منطقه</th><td>{{ $report->area }}</td></tr>
                <tr><th>نام قله</th><td>{{ $report->peak_name }}</td></tr>
                <tr><th>ارتفاع قله</th><td>{{ $report->peak_height }} متر</td></tr>
                <tr><th>ارتفاع مبدا</th><td>{{ $report->start_altitude }} متر</td></tr>
                <tr><th>مدت زمان</th><td>{{ $report->duration }}</td></tr>
                <tr><th>تاریخ شروع</th><td>{{ \Morilog\Jalali\Jalalian::fromDateTime($report->start_date)->format('Y/m/d') }}</td></tr>
                @if ($report->end_date)
                    <tr><th>تاریخ پایان</th><td>{{ \Morilog\Jalali\Jalalian::fromDateTime($report->end_date)->format('Y/m/d') }}</td></tr>
                @endif
            </table>
        </div>

        {{-- مسئولین --}}
        <div class="col-md-6">
            <h4 class="fw-bold">مسئولان برنامه</h4>
            <div class="row g-3">
                @foreach ([
                    'سرپرست' => $report->leader,
                    'کمک‌سرپرست' => $report->assistantLeader,
                    'مسئول فنی' => $report->technicalManager,
                    'راهنما' => $report->guide,
                    'پشتیبان' => $report->support
                ] as $role => $person)
                    @if ($person)
                        <div class="col-6">
                            <div class="card text-center">
                                <img src="{{ asset('storage/' . optional($person->profile)->profile_photo ?? 'default.png') }}" class="card-img-top mx-auto mt-2 rounded-circle" style="width:80px;height:80px;object-fit:cover;">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $person->first_name }} {{ $person->last_name }}</h6>
                                    <p class="card-text text-muted small">{{ $role }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- مشخصات فنی --}}
    <h4 class="fw-bold mt-4">ویژگی‌های فنی</h4>
    <table class="table table-bordered mb-5">
        <tr><th>سطح فنی</th><td>{{ $report->technical_level }}</td></tr>
        <tr><th>نوع مسیر</th><td>{{ $report->road_type }}</td></tr>
        <tr><th>وسایل حمل‌ونقل</th><td>{{ implode('، ', json_decode($report->transportation ?? '[]')) }}</td></tr>
        <tr><th>منابع آب</th><td>{{ implode('، ', json_decode($report->water_type ?? '[]')) }}</td></tr>
        <tr><th>آنتن‌دهی</th><td>{{ $report->signal_status ? 'دارد' : 'ندارد' }}</td></tr>
        <tr><th>تجهیزات لازم</th><td>{{ implode('، ', json_decode($report->required_equipment ?? '[]')) }}</td></tr>
        <tr><th>مهارت‌های لازم</th><td>{{ implode('، ', json_decode($report->required_skills ?? '[]')) }}</td></tr>
        <tr><th>سطح سختی</th><td>{{ $report->difficulty }}</td></tr>
        <tr><th>زاویه شیب</th><td>{{ $report->slope_angle }}</td></tr>
        <tr><th>سنگ‌نوردی</th><td>{{ $report->has_stone_climbing ? 'دارد' : 'ندارد' }}</td></tr>
        <tr><th>یخ‌نوردی</th><td>{{ $report->has_ice_climbing ? 'دارد' : 'ندارد' }}</td></tr>
        <tr><th>میانگین وزن کوله</th><td>{{ $report->average_backpack_weight }}</td></tr>
    </table>

    {{-- طبیعت و فرهنگ --}}
    <h4 class="fw-bold mt-4">ویژگی‌های طبیعت و منطقه</h4>
    <table class="table table-bordered mb-5">
        <tr><th>توضیح طبیعت</th><td>{{ $report->natural_description }}</td></tr>
        <tr><th>آب و هوا</th><td>{{ $report->weather }}</td></tr>
        <tr><th>سرعت باد</th><td>{{ $report->wind_speed }} کیلومتر بر ساعت</td></tr>
        <tr><th>دما</th><td>{{ $report->temperature }} درجه</td></tr>
        <tr><th>پوشش گیاهی</th><td>{{ $report->vegetation }}</td></tr>
        <tr><th>حیات وحش</th><td>{{ $report->wildlife }}</td></tr>
        <tr><th>زبان محلی</th><td>{{ $report->local_language }}</td></tr>
        <tr><th>آثار تاریخی</th><td>{{ $report->historical_sites }}</td></tr>
        <tr><th>نکات مهم</th><td>{{ $report->important_notes }}</td></tr>
        <tr><th>وضعیت غذا</th><td>{{ $report->food_availability }}</td></tr>
    </table>

    {{-- نقاط مسیر --}}
    @if($report->route_points)
        <h4 class="fw-bold mt-4">نقاط مسیر</h4>
        <table class="table table-bordered mb-5">
            @foreach(json_decode($report->route_points, true) as $point)
                <tr>
                    <th>{{ $point['name'] ?? '-' }}</th>
                    <td>Lat: {{ $point['lat'] ?? '-' }} | Lon: {{ $point['lon'] ?? '-' }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    {{-- زمان‌بندی اجرا --}}
    @if($report->execution_schedule)
        <h4 class="fw-bold mt-4">زمان‌بندی اجرا</h4>
        <table class="table table-bordered mb-5">
            @foreach(json_decode($report->execution_schedule, true) as $schedule)
                <tr>
                    <th>{{ $schedule['time'] ?? '-' }}</th>
                    <td>{{ $schedule['event'] ?? '-' }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    {{-- متن کامل گزارش --}}
    @if ($report->full_report)
        <h4 class="fw-bold mt-4">متن کامل گزارش</h4>
        <div class="border p-3 mb-5 bg-light rounded">
            {!! nl2br(e($report->full_report)) !!}
        </div>
    @endif

    {{-- دکمه‌ها --}}
    <div class="d-flex justify-content-between mt-5">
        <a href="{{ route('reports.archive') }}" class="btn btn-outline-secondary">بازگشت به آرشیو گزارش‌ها</a>
        @if ($report->pdf_path)
            <a href="{{ asset('storage/' . $report->pdf_path) }}" target="_blank" class="btn btn-success">دانلود فایل PDF</a>
        @endif
    </div>

</div>
@endsection
