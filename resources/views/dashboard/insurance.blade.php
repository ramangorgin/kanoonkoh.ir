@extends('layouts.app')

@section('title', 'بیمه ورزشی')

@section('content')
<div class="container my-5">
    <h5 class="mb-3">اطلاعات بیمه ورزشی</h5>

    @php $insurance = auth()->user()->insurance; @endphp

    @if($insurance && $insurance->expires_at && $insurance->expires_at < now())
        <div class="alert alert-danger">
            بیمه شما منقضی شده است. لطفاً اطلاعات جدید را وارد نمایید.
        </div>
    @endif

    <form method="POST" action="{{ route('dashboard.insurance.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            {{-- تاریخ صدور --}}
            <div class="mb-3 col-md-6">
                <label class="form-label">تاریخ صدور بیمه</label>
                <input type="text" name="issued_at" class="form-control datepicker" id="issued_at" value="{{ old('issued_at', optional($insurance?->issued_at)->format('Y-m-d')) }}" required>

            </div>

            {{-- تاریخ انقضا --}}
            <div class="mb-3 col-md-6">
                <label class="form-label">تاریخ انقضا بیمه</label>
                <input type="text" name="expires_at" class="form-control datepicker" id="expires_at" value="{{ old('expires_at', optional($insurance?->expires_at)->format('Y-m-d')) }}" required>
            </div>

            {{-- فایل فعلی --}}
            @if($insurance && $insurance->file_path)
                <div class="mb-3 col-12">
                    <label class="form-label">فایل بیمه فعلی</label><br>
                    <a href="{{ asset('storage/' . $insurance->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">مشاهده فایل فعلی</a>
                </div>
            @endif

            {{-- فایل جدید --}}
            <div class="mb-3 col-12">
                <label class="form-label">بارگذاری فایل جدید</label>
                <input type="file" name="file_path" class="form-control" accept=".pdf,image/*">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">ذخیره اطلاعات بیمه</button>
    </form>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $(".datepicker").MdPersianDateTimePicker({
            targetTextSelector: "#issued_at",
            textFormat: "yyyy/MM/dd",
            englishNumber: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".datepicker").MdPersianDateTimePicker({
            targetTextSelector: "#expires_at",
            textFormat: "yyyy/MM/dd",
            englishNumber: true
        });
    });
</script>
@endpush
@endsection
