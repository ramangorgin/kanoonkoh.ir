<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>باشگاه کانون کوه | @yield('title', 'صفحه‌اصلی')</title>

    {{-- Bootstrap CSS (RTL) --}}

    {{-- Bootstrap RTL CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Optional custom styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">   

    {{-- فونت دلخواه (مثلاً وزیر) --}}
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" />

    {{-- استایل سفارشی --}}
    <style>
        body {
            font-family: Vazirmatn, Tahoma, sans-serif;
            background-color: #f8f9fa;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Header --}}
    @include('layouts.partials.header')

    {{-- Content--}}
    <main class="container py-4">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.0.6/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>

    <script>
    $(document).ready(function () {
        $(".datepicker").persianDatepicker({
            format: 'YYYY/MM/DD',
            calendarType: 'persian',
            initialValueType: 'gregorian',
            autoClose: true,
            observer: true,
            altFieldFormatter: function (unix) {
                return new persianDate(unix).toCalendar('gregorian').format('YYYY-MM-DD');
            }
        });
    });
    </script>
     @stack('scripts')
</body>
</html>