<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3" dir="rtl">
    <div class="container">
        {{-- لوگو و دکمه همبرگر --}}
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="لوگو" height="50">
        </a>

        {{-- همبرگر --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="نمایش منو">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- منو و دکمه‌ها --}}
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-lg-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">خانه</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('programs.archive') }}">برنامه‌ها</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('courses.archive') }}">دوره‌ها</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reports.archive') }}">گزارش‌ها</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">درباره ما</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">تماس با ما</a></li>
            </ul>

            {{-- دکمه‌های ثبت‌نام و ورود --}}
            <div class="d-flex flex-column flex-lg-row gap-2">
                <a href="{{ route('register') }}" class="btn btn-outline-primary">ثبت‌نام</a>
                <a href="{{ route('login') }}" class="btn btn-primary">ورود</a>
            </div>
        </div>
    </div>
</nav>
