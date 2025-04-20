<footer class="bg-dark text-white mt-5 pt-4 pb-3">
    <div class="container">
        <div class="row align-items-center mb-3">

            {{-- لوگو --}}
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
            <img src="{{ asset('assets/WhiteLogo.png') }}" alt="لوگو" height="50">
            </div>

            {{-- لینک‌های اصلی --}}
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <a href="{{ url('/') }}" class="text-white me-3">خانه</a>
                <a href="{{ url('/about') }}" class="text-white me-3">درباره ما</a>
                <a href="{{ url('/contact') }}" class="text-white">تماس با ما</a>
            </div>

            {{-- شبکه‌های اجتماعی یا شماره تماس در آینده --}}
            <div class="col-md-4 text-center text-md-end">
                <span>شماره تماس: ۰۹۱۲xxxxxxx</span>
            </div>
        </div>

        <hr class="border-top border-light">

        {{-- امضای پایین فوتر --}}
        <div class="text-center small mt-3">
            طراحی شده توسط
            <a href="https://www.linkedin.com/in/ramangorginpaveh" class="text-warning fw-bold" target="_blank">
                رامان
            </a>
        </div>
    </div>
</footer>
