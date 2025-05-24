@extends('layouts.app')

@section('title', 'خانه')

@section('content')

<div class="hero-slider">
    {{-- ۱۰ اسلاید --}}
    @for ($i = 1; $i <= 10; $i++)
        <div class="hero-slide" style="background-image: url('{{ asset('images/slider/slide' . $i . '.jpg') }}')"></div>
    @endfor

    {{-- کاور تیره --}}
    <div class="hero-overlay"></div>

    {{-- محتوا روی کاور --}}
    <div class="hero-content">
        <img src="{{ asset('images/logo-white.png') }}" alt="کانون کوه" style="height: 100px;" class="mb-4">
        <h2 class="mb-2">مؤسسه فرهنگی ورزشی باشگاه دوستداران قله‌ها و طبیعت</h2>
        <h4 class="mb-4">معروف به باشگاه کانون کوه</h4>
        <a href="{{ route('conditions') }}" class="btn btn-primary px-4 ms-2">شرایط عضویت</a>
        <a href="{{ url('/#about') }}" class="btn btn-outline-light px-4">درباره باشگاه</a>
    </div>
</div>
<section id="about" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            {{-- متن معرفی --}}
            <div class="col-md-6 mb-4 mb-md-0">
                <h3 class="mb-4">درباره باشگاه کانون کوه</h3>
                <p>
                    باشگاه کانون کوه ریشه در فعالیت‌های گروهی کارکنان بازنشسته شرکت‌های صنعتی دارد که با هدف حفظ سلامت، تقویت روحیه، و انسجام اجتماعی به کوهنوردی ادامه دادند. از سال ۱۳۸۹، با سازماندهی و تشکیل هیئت مؤسس، گروه شکل گرفت و در سال ۱۳۹۶ به ثبت رسمی به‌عنوان موسسه فرهنگی ورزشی رسید. کانون کوه امروز یکی از فعال‌ترین باشگاه‌های کوهنوردی و طبیعت‌گردی در کشور است که با تکیه بر آموزش، مسئولیت‌پذیری، محیط‌زیست و برنامه‌ریزی دقیق فعالیت می‌کند.
                </p>
            </div>

            {{-- تایم‌لاین عکس‌دار --}}
            <div class="col-md-6">
                <h3 class="mb-4">مسیر ما تا امروز</h3>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-img">
                            <img src="{{ asset('images/timeline/1389.jpg') }}" alt="1389">
                        </div>
                        <div class="timeline-content">
                            <h5>۱۳۸۹ - آغاز شکل‌گیری گروه</h5>
                            <p>تشکیل هیئت مؤسس توسط پیشکسوتان کوهنوردی</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-img">
                            <img src="{{ asset('images/timeline/1390.jpg') }}" alt="1390">
                        </div>
                        <div class="timeline-content">
                            <h5>۱۳۹۰ - ساختار سازمانی</h5>
                            <p>تشکیل کارگروه‌های فنی، آموزش، محیط‌زیست و فرهنگی</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-img">
                            <img src="{{ asset('images/timeline/1396.jpg') }}" alt="1396">
                        </div>
                        <div class="timeline-content">
                            <h5>۱۳۹۶ - ثبت رسمی موسسه</h5>
                            <p>ثبت رسمی کانون کوه به‌عنوان موسسه فرهنگی ورزشی</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-img">
                            <img src="{{ asset('images/timeline/1397.jpg') }}" alt="1397">
                        </div>
                        <div class="timeline-content">
                            <h5>۱۳۹۷ - اولین مجوز باشگاه</h5>
                            <p>دریافت مجوز رسمی از اداره ورزش کرج</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-img">
                            <img src="{{ asset('images/timeline/1402.jpg') }}" alt="1402">
                        </div>
                        <div class="timeline-content">
                            <h5>۱۴۰۲ - توسعه ساختار دیجیتال</h5>
                            <p>راه‌اندازی وب‌سایت رسمی کانون کوه و ثبت‌نام آنلاین</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- بخش سوم: آخرین برنامه‌ها --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">آخرین برنامه‌ها</h3>
            <a href="{{ route('programs.index') }}" class="btn btn-outline-primary btn-sm">مشاهده همه</a>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($latestPrograms as $program)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $program->title }}</h5>
                            <p class="card-text text-muted">
                                تاریخ برگزاری: {{ jdate($program->date)->format('Y/m/d') }}
                            </p>
                            <p class="card-text flex-grow-1">
                                {{ Str::limit(strip_tags($program->description), 100, '...') }}
                            </p>
                            <a href="{{ route('programs.show', $program->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                مشاهده جزئیات
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- بخش چهارم: آخرین دوره‌ها --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">آخرین دوره‌ها</h3>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary btn-sm">مشاهده همه</a>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($latestCourses as $course)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text text-muted">
                                تاریخ برگزاری: {{ jdate($course->date)->format('Y/m/d') }}
                            </p>
                            <p class="card-text flex-grow-1">
                                {{ Str::limit(strip_tags($course->description), 100, '...') }}
                            </p>
                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                مشاهده جزئیات
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- بخش پنجم: آخرین گزارش‌ها --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">آخرین گزارش‌ها</h3>
            <a href="{{ route('reports.index') }}" class="btn btn-outline-primary btn-sm">مشاهده همه</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($latestReports as $report)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $report->program->title ?? 'گزارش بدون عنوان' }}</h5>
                            <p class="card-text text-muted">
                                تاریخ برنامه: {{ optional($report->program)->date ? jdate($report->program->date)->format('Y/m/d') : '-' }}
                            </p>
                            <p class="card-text flex-grow-1">
                                {{ Str::limit(strip_tags($report->content), 120, '...') }}
                            </p>
                            <a href="{{ route('reports.show', $report->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                مشاهده گزارش کامل
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
{{-- بخش ششم: تماس با ما --}}
<section id="contact" class="py-5 bg-light">
    <div class="container">
        <h3 class="mb-4 text-center">تماس با کانون کوه</h3>

        <div class="row g-4">
            {{-- اطلاعات تماس --}}
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="bi bi-telephone-fill text-primary me-2"></i>
                        <strong>شماره تماس:</strong> 09106871185
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-telephone text-primary me-2"></i>
                        <strong>تلفن ثابت:</strong> 02633508018
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                        <strong>آدرس:</strong>
                        کرج، گلشهر، بلوار گلزار غربی، خیابان یاس، ساختمان سینا، طبقه سوم، واحد ۶
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-mailbox text-success me-2"></i>
                        <strong>کد پستی:</strong> 3198717815
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-instagram text-danger me-2"></i>
                        <strong>اینستاگرام:</strong>
                        <a href="https://instagram.com/kanoonkooh" target="_blank">@kanoonkooh</a>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-telegram text-primary me-2"></i>
                        <strong>تلگرام:</strong>
                        <a href="https://t.me/kanoonkoh" target="_blank">@kanoonkoh</a>
                    </li>
                </ul>

                {{-- نقشه OpenStreetMap --}}
                <div id="map-contact" class="rounded border mt-4" style="height: 300px;"></div>
            </div>

            {{-- فرم ارسال پیام --}}
            <div class="col-md-6">
                <form method="POST" action="{{ route('contact.send') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">نام</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">پیام</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">ارسال پیام</button>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const mapContact = L.map('map-contact').setView([35.755, 50.954], 15); // مختصات حدودی گلشهر کرج
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(mapContact);
    L.marker([35.755, 50.954]).addTo(mapContact)
        .bindPopup('کانون کوه').openPopup();
</script>
@endpush
