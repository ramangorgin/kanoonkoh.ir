<footer class="bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">
        {{-- ردیف بالا: لینک‌های مفید --}}
        <div class="row text-center text-md-start">
            <div class="col-md-6 mb-4 mb-md-0">
                <h5 class="mb-3">دسترسی سریع</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-light text-decoration-none">خانه</a></li>
                    <li><a href="{{ route('programs.index') }}" class="text-light text-decoration-none">برنامه‌ها</a></li>
                    <li><a href="{{ route('courses.index') }}" class="text-light text-decoration-none">دوره‌ها</a></li>
                    <li><a href="{{ route('reports.index') }}" class="text-light text-decoration-none">گزارش‌ها</a></li>
                    <li><a href="{{ url('/#about') }}" class="text-light text-decoration-none">درباره ما</a></li>
                    <li><a href="{{ url('/#contact') }}" class="text-light text-decoration-none">تماس با ما</a></li>
                </ul>
            </div>

            {{-- جای خالی برای اطلاعات تماس یا لوگو در آینده --}}
            <div class="col-md-6 text-md-end">
                <h5 class="mb-3">کانون کوه</h5>
                <p>باشگاه کوهنوردی و طبیعت‌گردی برای علاقه‌مندان به ماجراجویی، آموزش و همراهی.</p>
            </div>
        </div>

        <hr class="border-light my-4">

        {{-- ردیف پایین: سال + امضا --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>© {{ jdate()->format('Y') }} کانون کوه. همه حقوق محفوظ است.</div>
            <div class="mt-2 mt-md-0">
                طراحی شده توسط
                <a href="https://www.linkedin.com/in/ramangorgin" class="text-warning text-decoration-none fw-bold" target="_blank">
                    رامان گرگین پاوه
                </a>
            </div>
        </div>
    </div>
</footer>
