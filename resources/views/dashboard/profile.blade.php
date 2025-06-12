@extends('layouts.dashboard')

@section('title', 'تکمیل مشخصات کاربری')

@section('breadcrumb')
    <a href="{{ route('dashboard.index') }}">داشبورد</a> / <span>مشخصات کاربری</span>
@endsection

@section('content')


<div class="container py-4">
    <h4 class="mb-4">مشخصات کاربری</h4>



@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form method="POST" action="{{ route('dashboard.profile.store') }}" enctype="multipart/form-data">
        @csrf
        {{-- مشخصات اولیه --}}
        <h5 class="mt-4">مشخصات اولیه</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>نام</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>نام خانوادگی</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>جنسیت</label>
                <select name="gender" class="form-select" required>
                    <option value="">انتخاب کنید</option>
                    <option value="male">مرد</option>
                    <option value="female">زن</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>تاریخ تولد</label>
                <input type="text" name="birth_date" id="birth_date"  class="form-control datepicker" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>نام پدر</label>
                <input type="text" name="father_name" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>کد ملی</label>
                <input type="text" name="national_id" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>عکس پرسنلی</label>
                <input type="file" name="personal_photo" class="form-control">
                <small class="form-text text-muted">عکس باید واضح و از چهره روبرو باشد. فرمت مجاز: JPG یا PNG. حداکثر حجم: ۲ مگابایت.</small>
            </div>
        </div>

        {{-- اطلاعات تماس --}}
        <h5 class="mt-4">اطلاعات تماس</h5>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>تلفن همراه</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>استان</label>
                <input type="text" name="province" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>شهر</label>
                <input type="text" name="city" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>کد پستی</label>
                <input type="text" name="postal_code" class="form-control">
            </div>
            <div class="col-md-12 mb-3">
                <label>آدرس</label>
                <textarea name="address" class="form-control" rows="2"></textarea>
            </div>
        </div>

        {{-- اطلاعات پزشکی --}}
        <h5 class="mt-4">وضعیت جسمانی</h5>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label>قد (cm)</label>
                <input type="number" name="height" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label>وزن (kg)</label>
                <input type="number" name="weight" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label>گروه خونی</label>
                <select name="blood_type" class="form-select">
                    <option value="">انتخاب کنید</option>
                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                        <option>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>عمل جراحی داشته‌اید؟</label>
                <select name="had_surgery" class="form-select">
                    <option value="0">خیر</option>
                    <option value="1">بله</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>وضعیت جسمی خاص</label>
                <input type="text" name="medical_conditions" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>آلرژی‌ها</label>
                <input type="text" name="allergies" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>داروی مورد استفاده</label>
                <input type="text" name="medications" class="form-control">
            </div>
        </div>

        {{-- اطلاعات تکمیلی --}}
        <h5 class="mt-4">اطلاعات تکمیلی</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>شغل</label>
                <input type="text" name="job" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>معرف</label>
                <input type="text" name="referrer" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>تلفن شخص اضطراری</label>
                <input type="text" name="emergency_phone" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>نام شخص اضطراری</label>
                <input type="text" name="emergency_contact_name"  class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>نسبت با شخص اضطراری</label>
                <input type="text" name="emergency_contact_relation"  class="form-control">
            </div>
        </div>


        <button class="btn btn-primary py-2" style="width: 100%;" type="submit">ثبت مشخصات</button>
        </form>

</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $("#birth_date").persianDatepicker({
            format: 'YYYY-MM-DD',
            autoClose: true,
            initialValue: false,
            observer: true,
            calendar: {
                persian: {
                    locale: 'fa'
                }
            }
        });
    });
</script>
@endpush