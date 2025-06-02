@extends('layouts.dashboard')

@section('title', 'پرداخت‌ها')

@section('breadcrumb')
    <a href="{{ route('dashboard.index') }}">داشبورد</a> / <span>پرداخت‌ها</span>
@endsection

@section('content')

@php
    $recentPrograms = $recentPrograms ?? [];
    $recentCourses = $recentCourses ?? [];
    $membershipYears = $membershipYears ?? [];
    $latestTransaction = $latestTransaction ?? null;
@endphp

<div class="container my-5">
    <h5 class="mb-3">ثبت پرداخت جدید</h5>

    <form method="POST" action="{{ route('dashboard.payment.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            {{-- نوع پرداخت --}}
            <div class="mb-3 col-md-6">
                <label class="form-label">مورد پرداخت</label>
                <select name="type" id="payment_type" class="form-select" required>
                    <option value="">انتخاب کنید...</option>
                    <option value="membership">حق عضویت</option>
                    <option value="program">برنامه</option>
                    <option value="course">دوره</option>
                </select>
            </div>

            {{-- آیتم مربوط --}}
            <div class="mb-3 col-md-6 d-none" id="related_item_wrapper">
                <label id="related_item_label" class="form-label"></label>
                <select name="related_id" id="related_item" class="form-select"></select>
            </div>

            {{-- سال عضویت (شمسی) --}}
            <div class="mb-3 col-md-6 d-none" id="membership_year_wrapper">
                <label class="form-label">سال عضویت (شمسی)</label>
                <select name="year" id="membership_year" class="form-select">
                    <option value="">انتخاب سال</option>
                    @foreach($membershipYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jalali_date">تاریخ پرداخت</label>
                <input type="text" id="jalali_date" class="form-control" placeholder="تاریخ پرداخت را وارد کنید" required>
                <input type="hidden" name="date" id="gregorian_date">
            </div>


            {{-- فایل رسید --}}
            <div class="mb-3 col-md-12">
                <label class="form-label">آپلود رسید (اختیاری)</label>
                <input type="file" name="receipt_file" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">ارسال</button>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('payment_type');
        const relatedWrapper = document.getElementById('related_item_wrapper');
        const relatedSelect = document.getElementById('related_item');
        const label = document.getElementById('related_item_label');
        const membershipWrapper = document.getElementById('membership_year_wrapper');

        const recentPrograms = @json($recentPrograms);
        const recentCourses = @json($recentCourses);
        const membershipYears = @json($membershipYears);

        typeSelect.addEventListener('change', () => {
            const type = typeSelect.value;

            relatedWrapper.classList.add('d-none');
            relatedSelect.innerHTML = '';
            membershipWrapper.classList.add('d-none');

            if (type === 'membership') {
                membershipWrapper.classList.remove('d-none');
            } else if (type === 'program') {
                label.innerText = 'انتخاب برنامه';
                relatedPrograms();
            } else if (type === 'course') {
                label.innerText = 'انتخاب دوره';
                relatedCourses();
            }

            function relatedPrograms() {
                relatedWrapper.classList.remove('d-none');
                recentPrograms.forEach(item => {
                    relatedSelect.innerHTML += `<option value="${item.id}">${item.title}</option>`;
                });
            }

            function relatedCourses() {
                relatedWrapper.classList.remove('d-none');
                recentCourses.forEach(item => {
                    relatedSelect.innerHTML += `<option value="${item.id}">${item.title}</option>`;
                });
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css">

<script>
    $(document).ready(function () {
        $("#jalali_date").persianDatepicker({
            format: 'YYYY/MM/DD',
            autoClose: true,
            calendar: {
                persian: {
                    locale: 'fa'
                }
            },
            altField: '#gregorian_date',
            altFormat: 'YYYY-MM-DD',
            altFieldFormatter: function (unix) {
                return new persianDate(unix).toGregorian().format("YYYY-MM-DD");
            }
        });
    });
</script>

@endpush

@endsection
