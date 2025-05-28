<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        {{-- ستون راست (لوگو) --}}
        <a class="navbar-brand order-1 order-lg-1" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="کانون کوه" style="height: 60px;">
        </a>

        {{-- ستون وسط (منو اصلی - فقط در لپ‌تاپ) --}}
        <div class="d-none d-lg-block order-2 w-100 text-center">
            <ul class="navbar-nav justify-content-center flex-row gap-4">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">خانه</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('programs.index') }}">برنامه‌ها</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('courses.index') }}">دوره‌ها</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">گزارش‌ها</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/#about') }}">درباره ما</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/#contact') }}">تماس با ما</a></li>
            </ul>
        </div>

        {{-- ستون چپ (ورود/ثبت‌نام - فقط در لپ‌تاپ) --}}
        <div class="d-none d-lg-block order-3">
            @auth
            <a href="{{ route('dashboard.index') }}" class="btn btn-outline-secondary py-3 px-5">داشبورد</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary ms-2"> ورود </a>
                <a href="{{ route('register') }}" class="btn btn-primary">ثبت‌نام</a>
            @endauth
        </div>

        {{-- همبرگر موبایل --}}
        <button class="navbar-toggler d-lg-none order-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu" aria-controls="mobileMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

{{-- موبایل منو --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">منو</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">خانه</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('programs.index') }}">برنامه‌ها</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('courses.index') }}">دوره‌ها</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">گزارش‌ها</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/#about') }}">درباره ما</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/#contact') }}">تماس با ما</a></li>
        </ul>

        <hr>

        @auth
            <a href="{{ route('dashboard.index') }}" class="btn btn-outline-secondary w-100 mb-2">ورود به داشبورد</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 mb-2">ورود</a>
            <a href="{{ route('register') }}" class="btn btn-primary w-100">ثبت‌نام</a>
        @endauth
    </div>
</div>
