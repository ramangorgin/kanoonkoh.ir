@extends('layout')

@section('title', 'باشگاه کانون کوه')

@section('content')
<div class="container-fluid p-0">

    {{-- 1. اسلایدشو --}}
    <div id="mainCarousel" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @for($i = 1; $i <= 62; $i++)
                <div class="carousel-item {{ $i === 1 ? 'active' : '' }}">
                    <img src="{{ asset('assets/images/slides/' . $i . '.jpg') }}" class="d-block w-100" alt="slide {{ $i }}">
                </div>
            @endfor
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- 2. معرفی باشگاه --}}
    <section class="container py-5">
        <h2 class="text-center mb-4 text-primary">درباره باشگاه کانون کوه</h2>
        <p class="lead text-center">
            کانون کوه از دل گروهی از کوهنوردان حرفه‌ای که عمدتاً از کارکنان بازنشسته شرکت‌های بزرگ صنعتی مانند سایپا و ایران‌خودرو بودند، شکل گرفت.
            این باشگاه با هدف ارتقای سلامت جسمی و روحی فعالیت‌های متنوع کوهنوردی، آموزشی و فرهنگی برگزار می‌کند.
        </p>
    </section>

    {{-- 3. آخرین برنامه‌ها --}}
    <section class="container py-5">
        <h3 class="mb-4">آخرین برنامه‌ها</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($programs as $program)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $program->cover_image) }}" class="card-img-top" alt="{{ $program->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $program->title }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($program->description), 100) }}</p>
                            <a href="{{ route('programs.show', $program) }}" class="btn btn-outline-primary">مشاهده</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 4. آخرین گزارش‌ها --}}
    <section class="container py-5">
        <h3 class="mb-4">آخرین گزارش‌ها</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($reports as $report)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $report->cover_image) }}" class="card-img-top" alt="{{ $report->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $report->title }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($report->full_report), 100) }}</p>
                            <a href="{{ route('reports.show', $report) }}" class="btn btn-outline-success">مطالعه گزارش</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 5. آخرین دوره‌ها --}}
    <section class="container py-5">
        <h3 class="mb-4">آخرین دوره‌های آموزشی</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($courses as $course)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $course->cover_image) }}" class="card-img-top" alt="{{ $course->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($course->description), 100) }}</p>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-dark">اطلاعات دوره</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 6. تماس با ما (خلاصه) --}}
    <section class="bg-dark text-white text-center py-5">
        <h4>تماس با باشگاه کانون کوه</h4>
        <p class="mb-1">ایمیل: info@kanoonkoh.ir</p>
        <p class="mb-1">تلفن: ۰۹۱۲۱۲۳۴۵۶۷</p>
        <p>آدرس: تهران، خیابان مثال، باشگاه کانون کوه</p>
    </section>

</div>
@endsection
