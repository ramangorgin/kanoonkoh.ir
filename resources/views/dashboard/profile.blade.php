@extends('layouts.dashboard')

@section('title', 'تکمیل مشخصات کاربری')

@section('breadcrumb')
    <a href="{{ route('dashboard.index') }}">داشبورد</a> / <span>مشخصات کاربری</span>
@endsection

@section('content')

<div class="container py-4">
    <h4 class="mb-4">تکمیل مشخصات کاربری</h4>
    <form action="{{ route('dashboard.profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- مشخصات اولیه --}}
        <h5 class="mt-4">مشخصات اولیه</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>نام</label>
                <input type="text" name="first_name" value="{{ old('first_name', $profile->first_name ?? '') }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>نام خانوادگی</label>
                <input type="text" name="last_name" value="{{ old('last_name', $profile->last_name ?? '') }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>جنسیت</label>
                <select name="gender" class="form-select" required>
                    <option value="">انتخاب کنید</option>
                    <option value="male" @selected(old('gender', $profile->gender ?? '') === 'male')>مرد</option>
                    <option value="female" @selected(old('gender', $profile->gender ?? '') === 'female')>زن</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>تاریخ تولد</label>
                <input type="text" name="birth_date" id="birth_date" value="{{ old('birth_date', $profile->birth_date ?? '') }}" class="form-control datepicker" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>نام پدر</label>
                <input type="text" name="father_name" value="{{ old('father_name', $profile->father_name ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>کد ملی</label>
                <input type="text" name="national_id" value="{{ old('national_id', $profile->national_id ?? '') }}" class="form-control">
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
            <div class="col-md-6 mb-3">
                <label>تلفن همراه</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>استان</label>
                <input type="text" name="province" value="{{ old('province', $profile->province ?? '') }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>شهر</label>
                <input type="text" name="city" value="{{ old('city', $profile->city ?? '') }}" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>کد پستی</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code ?? '') }}" class="form-control">
            </div>
            <div class="col-md-12 mb-3">
                <label>آدرس</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address', $profile->address ?? '') }}</textarea>
            </div>
        </div>

        {{-- اطلاعات پزشکی --}}
        <h5 class="mt-4">وضعیت جسمانی</h5>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label>قد (cm)</label>
                <input type="number" name="height" value="{{ old('height', $profile->height ?? '') }}" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label>وزن (kg)</label>
                <input type="number" name="weight" value="{{ old('weight', $profile->weight ?? '') }}" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label>گروه خونی</label>
                <select name="blood_type" class="form-select">
                    <option value="">انتخاب کنید</option>
                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                        <option value="{{ $type }}" @selected(old('blood_type', $profile->blood_type ?? '') === $type)>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>عمل جراحی داشته‌اید؟</label>
                <select name="has_surgery" class="form-select">
                    <option value="0" @selected(old('has_surgery', $profile->has_surgery ?? '') == 0)>خیر</option>
                    <option value="1" @selected(old('has_surgery', $profile->has_surgery ?? '') == 1)>بله</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>وضعیت جسمی خاص</label>
                <input type="text" name="physical_condition" value="{{ old('physical_condition', $profile->physical_condition ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>آلرژی‌ها</label>
                <input type="text" name="allergies" value="{{ old('allergies', $profile->allergies ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>داروی مورد استفاده</label>
                <input type="text" name="medications" value="{{ old('medications', $profile->medications ?? '') }}" class="form-control">
            </div>
        </div>

        {{-- اطلاعات تکمیلی --}}
        <h5 class="mt-4">اطلاعات تکمیلی</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>شغل</label>
                <input type="text" name="job" value="{{ old('job', $profile->job ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>معرف</label>
                <input type="text" name="referrer" value="{{ old('referrer', $profile->referrer ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>تلفن شخص اضطراری</label>
                <input type="text" name="emergency_phone" value="{{ old('emergency_phone', $profile->emergency_phone ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>نام شخص اضطراری</label>
                <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $profile->emergency_contact_name ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>نسبت با شخص اضطراری</label>
                <input type="text" name="emergency_contact_relation" value="{{ old('emergency_contact_relation', $profile->emergency_contact_relation ?? '') }}" class="form-control">
            </div>
        </div>

        {{-- 📘 دوره‌های گذرانده‌شده پیش از عضویت --}}
        <h5 class="mb-3 mt-4">دوره‌های قبلی</h5>

        <div class="mb-3">
            <label class="form-label">آیا دوره‌ای پیش از عضویت در کانون کوه گذرانده‌اید؟</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="has_previous_courses" id="has_previous_courses_yes" value="yes">
                <label class="form-check-label" for="has_previous_courses_yes">بله</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="has_previous_courses" id="has_previous_courses_no" value="no" checked>
                <label class="form-check-label" for="has_previous_courses_no">خیر</label>
            </div>
        </div>

        <div id="previous_courses_section" class="border p-3 rounded bg-light d-none">
            <div id="courses_container">
                <div class="course-entry mb-3">
                    <label class="form-label">نام دوره</label>
                    <input type="text" name="courses[0][title]" class="form-control mb-2">

                    <label class="form-label">فایل مدرک </label>
                    <input type="file" name="courses[0][file]" class="form-control" accept=".pdf,image/*">
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-secondary" id="add_course_btn">افزودن دوره دیگر</button>
        </div>

        <button type="submit" class="btn btn-primary mt-3">ثبت و بروزرسانی</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const yesRadio = document.getElementById('has_previous_courses_yes');
        const noRadio = document.getElementById('has_previous_courses_no');
        const section = document.getElementById('previous_courses_section');
        const addBtn = document.getElementById('add_course_btn');
        const container = document.getElementById('courses_container');

        let courseIndex = 1;

        yesRadio.addEventListener('change', () => {
            section.classList.remove('d-none');
        });

        noRadio.addEventListener('change', () => {
            section.classList.add('d-none');
        });

        addBtn.addEventListener('click', () => {
            const html = `
                <div class="course-entry mb-3 border-top pt-3 mt-3">
                    <label class="form-label">نام دوره</label>
                    <input type="text" name="courses[${courseIndex}][title]" class="form-control mb-2">

                    <label class="form-label">فایل مدرک</label>
                    <input type="file" name="courses[${courseIndex}][file]" class="form-control" accept=".pdf,image/*">
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
            courseIndex++;
        });
    });
</script>
@endpush