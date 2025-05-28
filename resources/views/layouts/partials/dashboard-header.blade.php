<nav style=" padding-top: 0.3rem !important; padding-bottom: 0.3rem !important; min-height: 50px;" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        {{-- ستون راست (لوگو) --}}
        <a class="navbar-brand order-1 order-lg-1"  href="{{ route('home') }}">
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

        {{-- ستون چپ (نوتیفیکیشن و خروج) --}}
        <div class="d-none d-lg-flex order-3 align-items-center gap-3">
            {{-- دکمه نوتیفیکیشن --}}
            <div class="dropdown">
            <button class="btn btn-link text-dark position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell fs-4"></i>
                @if($unreadCount > 0)
                    <span style="position: absolute; top: 0; left: 0; transform: translate(-40%, -40%); background-color: red; color: white; font-size: 0.7rem; padding: 2px 5px; border-radius: 50%;">
                        {{ $unreadCount }}
                    </span>
                @endif
            </button>

                <ul class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="notificationDropdown" style="width: 350px;">
                    <li class="px-3 py-2 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">اعلان‌ها</h6>
                        <small><a href="#">مشاهده همه</a></small>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    {{-- نمونه اعلان‌ها --}}
                    @foreach($notifications as $notification)
                        <li>
                        <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item d-flex gap-3 py-2">
                        <div class="bg-primary bg-opacity-10 p-2 rounded">
                                    <i class="bi {{ $notification->icon ?? 'bi-info-circle' }} text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    <p class="mb-0">{{ $notification->message }}</p>
                                </div>
                            </a>
                        </li>
                    @endforeach

            </div>

            {{-- دکمه خروج --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="width: 100px;" id="exitButton" type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-left"></i> خروج
                </button>
            </form>
        </div>

        {{-- همبرگر موبایل --}}
        <button class="navbar-toggler d-lg-none order-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileDashboardMenu" aria-controls="mobileDashboardMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

{{-- موبایل منو --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileDashboardMenu" aria-labelledby="mobileDashboardMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">منوی کاربری</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index') }}">داشبورد</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.programs') }}">برنامه‌های من</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.courses') }}">دوره‌های من</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.reports.index') }}">گزارش‌های من</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.tickets.index') }}">پشتیبانی</a></li>
        </ul>

        <hr>

        {{-- نوتیفیکیشن در موبایل --}}
        <div class="mb-3">
            <a href="#" class="btn btn-light w-100 text-start position-relative">
                <i class="bi bi-bell me-2"></i> اعلان‌ها
                <span class="position-absolute top-50 end-0 translate-middle-y badge rounded-pill bg-danger me-3">
                    3
                </span>
            </a>
        </div>

        {{-- دکمه خروج در موبایل --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="bi bi-box-arrow-left"></i> خروج از سیستم
            </button>
        </form>
    </div>
</div>

@push('styles')
<style>
    /* استایل‌های سفارشی برای هدر */
    .navbar {
        position: sticky;
        top: 0;
        z-index: 1030;
    }
    .dropdown-menu {
        max-height: 400px;
        overflow-y: auto;
    }
    .notification-badge {
        font-size: 0.6rem;
    }
</style>
@endpush