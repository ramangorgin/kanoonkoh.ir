<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'داشبورد')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" rel="stylesheet" >
    <link href="{{ asset('css/custom-pdatepicker.css') }}" rel="stylesheet">

    @stack('styles')
    <style>

        body {
            margin: 0;
            font-family: 'Sahel', sans-serif;
            direction: rtl;
            background-color: #f9f9f9;
        }

        .dashboard-container {
            display: flex;
            flex-direction: row; /* این مهم‌ترین بخشه */
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #ffffff;
            border-left: 1px solid #ddd;
            padding: 25px 20px;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.05);
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            color: #212529;
            text-decoration: none;
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .breadcrumb {
            background-color: #e2e6ea;
            padding: 10px 20px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .active-link {
            background-color: #e7f1ff;
            color: #0d6efd;
            font-weight: bold;
            border-radius: 5px;
        }
        #userpanel{
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            justify-content: center;
            font-family: 'Vazirmatn', sans-serif;
            font-weight: 900;
        }
    </style>
</head>
<body>
@include('layouts.partials.dashboard-header', ['notifications' => $notifications, 'unreadCount' => $unreadCount])

    <div class="dashboard-container">

        {{-- Sidebar --}}
        <aside class="sidebar">
            <h5 class="text-center" id="userpanel" >پنل کاربری</h5>
            <a href="{{ route('dashboard.index') }}"
            class="{{ request()->routeIs('dashboard.index') ? 'active-link' : '' }}">
            🏠 خانه داشبورد
            </a>

            <a href="{{ route('dashboard.profile') }}"
            class="{{ request()->routeIs('dashboard.profile') ? 'active-link' : '' }}">
            🧑 ویرایش مشخصات
            </a>

            <a href="{{ route('dashboard.insurance') }}"
            class="{{ request()->routeIs('dashboard.insurance') ? 'active-link' : '' }}">
            👥 بیمه ورزشی
            </a>

            <a href="{{ route('dashboard.payments') }}"
            class="{{ request()->routeIs('dashboard.payments') ? 'active-link' : '' }}">
            💳 پرداخت‌ها
            </a>

            <a href="{{ route('dashboard.programs') }}"
            class="{{ request()->routeIs('dashboard.programs') ? 'active-link' : '' }}">
            📅 برنامه‌ها
            </a>

            <a href="{{ route('dashboard.courses') }}"
            class="{{ request()->routeIs('dashboard.courses') ? 'active-link' : '' }}">
            📘 دوره‌ها
            </a>

            <a href="{{ route('dashboard.reports.index') }}"
            class="{{ request()->routeIs('dashboard.reports.*') ? 'active-link' : '' }}">
            📝 گزارش‌ها
            </a>

            <a href="{{ route('dashboard.settings') }}"
            class="{{ request()->routeIs('dashboard.settings') ? 'active-link' : '' }}">
            ⚙️ تنظیمات
            </a>

            <a href="{{ route('dashboard.tickets.index') }}"
            class="{{ request()->routeIs('dashboard.tickets.*') ? 'active-link' : '' }}">
            🎫 تیکت‌ها
            </a>

            <a href="{{ route('logout') }}">
                🚪 خروج
            </a>
        </aside>

        {{-- Main Content --}}
        <div class="main-content">
            {{-- Breadcrumb --}}
            @hasSection('breadcrumb')
                <div class="breadcrumb">
                    @yield('breadcrumb')
                </div>
            @endif

            {{-- Page Content --}}
            @yield('content')
        </div>
    </div>
    @include('layouts.partials.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    
    @stack('scripts')
</body>
</html>

