{{-- فرم تکمیل مشخصات کاربر --}}
<form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data">
    @csrf

    {{-- 🪪 اطلاعات شناسنامه‌ای و هویتی --}}
    <h5 class="mb-3 mt-4">مشخصات هویتی</h5>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label">نام و نام خانوادگی</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">کد ملی</label>
            <input type="text" name="national_code" class="form-control" required maxlength="10">
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">تاریخ تولد</label>
            <input type="date" name="birthdate" class="form-control">
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">نام پدر</label>
            <input type="text" name="father_name" class="form-control">
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">جنسیت</label>
            <select name="gender" class="form-select">
                <option value="male">مرد</option>
                <option value="female">زن</option>
            </select>
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">عکس پرسنلی (jpg/png)</label>
            <input type="file" name="profile_photo" class="form-control" accept="image/*">
        </div>
    </div>

    {{-- 📞 اطلاعات تماس و آدرس --}}
    <h5 class="mb-3 mt-4">اطلاعات تماس و محل سکونت</h5>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label">شماره تماس</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">شماره تماس اضطراری</label>
            <input type="text" name="emergency_contact" class="form-control">
        </div>

        <div class="mb-3 col-md-4">
            <label class="form-label">استان</label>
            <input type="text" name="province" class="form-control">
        </div>

        <div class="mb-3 col-md-4">
            <label class="form-label">شهر</label>
            <input type="text" name="city" class="form-control">
        </div>

        <div class="mb-3 col-md-4">
            <label class="form-label">کد پستی</label>
            <input type="text" name="postal_code" class="form-control">
        </div>

        <div class="mb-3 col-12">
            <label class="form-label">آدرس دقیق</label>
            <textarea name="address" class="form-control" rows="2"></textarea>
        </div>
    </div>

    {{-- 🛡 بیمه ورزشی --}}
    <h5 class="mb-3 mt-4">بیمه ورزشی</h5>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label">تاریخ صدور بیمه</label>
            <input type="date" name="insurance_issued_at" class="form-control">
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">تاریخ انقضا بیمه</label>
            <input type="date" name="insurance_expired_at" class="form-control">
        </div>

        <div class="mb-3 col-md-12">
            <label class="form-label">بارگذاری فایل بیمه (PDF یا عکس)</label>
            <input type="file" name="insurance_file" class="form-control" accept=".pdf,image/*">
        </div>
    </div>

    {{-- 📘 دوره‌های گذرانده‌شده پیش از عضویت --}}
    <h5 class="mb-3 mt-4">دوره‌های قبلی (اختیاری)</h5>

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

                <label class="form-label">فایل مدرک (PDF یا عکس)</label>
                <input type="file" name="courses[0][file]" class="form-control" accept=".pdf,image/*">
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-secondary" id="add_course_btn">افزودن دوره دیگر</button>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">ثبت مشخصات</button>
    </div>
</form>

@push('scripts')
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
