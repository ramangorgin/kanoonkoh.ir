<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت | کانون کوه</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js']) <!-- اگر از Vite استفاده می‌کنی -->
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-white p-3" style="min-width: 220px; height: 100vh;">
        <h5 class="mb-4">پنل مدیریت</h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.programs.index') }}">برنامه‌ها</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.courses.index') }}">دوره‌ها</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.reports.index') }}">گزارش‌ها</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.payments.index') }}">پرداخت‌ها</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.tickets.index') }}">تیکت‌ها</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.users.index') }}">کاربران</a></li>
        </ul>
    </nav>

    <!-- Content -->
    <main class="flex-fill p-4">
        @yield('content')
    </main>
</div>
</body>
</html>
