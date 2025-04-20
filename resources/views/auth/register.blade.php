@extends('layout')

@section('title', 'فرم عضویت')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">فرم عضویت در کانون کوه</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col">
                <label>نام</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="col">
                <label>نام خانوادگی</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>ایمیل</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col">
                <label>رمز عبور</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col">
                <label>تکرار رمز عبور</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>کد ملی</label>
                <input type="text" name="national_id" class="form-control" required>
            </div>
            <div class="col">
                <label>شماره تلفن</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>
            <div class="col">
                <label>شماره اضطراری</label>
                <input type="text" name="emergency_phone" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>نام پدر</label>
                <input type="text" name="father_name" class="form-control">
            </div>
            <div class="col">
                <label>جنسیت</label>
                <select name="gender" class="form-select" required>
                    <option value="">انتخاب کنید</option>
                    <option value="مرد">مرد</option>
                    <option value="زن">زن</option>
                    <option value="دیگر">دیگر</option>
                </select>
            </div>
            <div class="col">
                <label>تاریخ تولد</label>
                <input type="text" name="birth_date" id="birth_date" class="form-control" required autocomplete="off">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>آدرس</label>
                <input type="text" name="address_line" class="form-control" required>
            </div>
            <div class="col">
                <label>شهر</label>
                <input type="text" name="city" class="form-control" required>
            </div>
            <div class="col">
                <label>استان</label>
                <input type="text" name="province" class="form-control" required>
            </div>
            <div class="col">
                <label>کد پستی</label>
                <input type="text" name="postal_code" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>وضعیت تاهل</label>
                <select name="marital_status" class="form-select" required>
                    <option value="">انتخاب کنید</option>
                    <option value="تنها">تنها</option>
                    <option value="متاهل">متاهل</option>
                    <option value="جداشده">جداشده</option>
                    <option value="بیوه">بیوه</option>
                </select>
            </div>
            <div class="col">
                <label>نام معرف (اختیاری)</label>
                <input type="text" name="introducer" class="form-control">
            </div>
        </div>

        <div class="mb-4">
            <label>عکس پرسنلی (اختیاری)</label>
            <input type="file" name="profile_photo" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary w-100">ثبت‌نام</button>
    </form>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" rel="stylesheet">

    <script>
        $('#birth_date').persianDatepicker({
            format: 'YYYY/MM/DD',
            autoClose: true,
            initialValueType: 'gregorian',
            calendarType: 'persian',
        });
    </script>
@endpush
@endsection
