<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h4 class="mb-3">اطلاعات پایه</h4>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">نام</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', auth()->user()->first_name) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">نام خانوادگی</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', auth()->user()->last_name) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">نام پدر</label>
            <input type="text" name="father_name" class="form-control" value="{{ old('father_name', optional(auth()->user()->profile)->father_name) }}">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">تاریخ تولد (شمسی)</label>
            <input type="text" name="birth_date" class="form-control datepicker-jalali" value="{{ old('birth_date', optional(auth()->user()->profile)->birth_date ? \Morilog\Jalali\Jalalian::fromDateTime(auth()->user()->profile->birth_date)->format('Y/m/d') : '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">کد ملی</label>
            <input type="text" name="national_id" class="form-control" value="{{ old('national_id', optional(auth()->user()->profile)->national_id) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">جنسیت</label>
            <select name="gender" class="form-select">
                <option value="">انتخاب کنید</option>
                @foreach(['male' => 'مرد', 'female' => 'زن', 'other' => 'دیگر'] as $key => $label)
                    <option value="{{ $key }}" @selected(optional(auth()->user()->profile)->gender == $key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <h4 class="mt-4">اطلاعات تماس</h4>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">موبایل</label>
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', optional(auth()->user()->profile)->mobile) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">استان</label>
            <input type="text" name="province" class="form-control" value="{{ old('province', optional(auth()->user()->profile)->province) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">شهر</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', optional(auth()->user()->profile)->city) }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">آدرس</label>
        <textarea name="address" class="form-control">{{ old('address', optional(auth()->user()->profile)->address) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">کد پستی</label>
        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', optional(auth()->user()->profile)->postal_code) }}">
    </div>

    <h4 class="mt-4">اطلاعات اضطراری</h4>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">نام فرد اضطراری</label>
            <input type="text" name="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name', optional(auth()->user()->profile)->emergency_contact_name) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">شماره تماس اضطراری</label>
            <input type="text" name="emergency_contact_phone" class="form-control" value="{{ old('emergency_contact_phone', optional(auth()->user()->profile)->emergency_contact_phone) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">نسبت</label>
            <input type="text" name="emergency_contact_relation" class="form-control" value="{{ old('emergency_contact_relation', optional(auth()->user()->profile)->emergency_contact_relation) }}">
        </div>
    </div>

    <h4 class="mt-4">بیمه</h4>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">شماره بیمه</label>
            <input type="text" name="insurance_number" class="form-control" value="{{ old('insurance_number', optional(auth()->user()->profile)->insurance_number) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">تاریخ صدور (شمسی)</label>
            <input type="text" name="insurance_issue_date" class="form-control datepicker-jalali" value="{{ old('insurance_issue_date', optional(auth()->user()->profile)->insurance_issue_date ? \Morilog\Jalali\Jalalian::fromDateTime(auth()->user()->profile->insurance_issue_date)->format('Y/m/d') : '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">تاریخ انقضا (شمسی)</label>
            <input type="text" name="insurance_expiration_date" class="form-control datepicker-jalali" value="{{ old('insurance_expiration_date', optional(auth()->user()->profile)->insurance_expiration_date ? \Morilog\Jalali\Jalalian::fromDateTime(auth()->user()->profile->insurance_expiration_date)->format('Y/m/d') : '') }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">آپلود فایل بیمه</label>
        <input type="file" name="insurance_file" class="form-control">
    </div>

    <h4 class="mt-4">سلامت</h4>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">گروه خونی</label>
            <select name="blood_type" class="form-select">
                <option value="">انتخاب کنید</option>
                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                    <option value="{{ $type }}" @selected(optional(auth()->user()->profile)->blood_type == $type)>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">شرایط خاص یا بیماری</label>
            <input type="text" name="health_conditions" class="form-control" value="{{ old('health_conditions', optional(auth()->user()->profile)->health_conditions) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">آلرژی‌ها</label>
            <input type="text" name="allergies" class="form-control" value="{{ old('allergies', optional(auth()->user()->profile)->allergies) }}">
        </div>
    </div>

    <h4 class="mt-4">تجربه و دوره‌ها</h4>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">سطح تجربه</label>
            <select name="experience_level" class="form-select">
                <option value="">انتخاب کنید</option>
                @foreach(['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'] as $key => $label)
                    <option value="{{ $key }}" @selected(optional(auth()->user()->profile)->experience_level == $key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">تجهیزات شخصی (با کاما جدا شود)</label>
            <input type="text" name="personal_equipment" class="form-control" value="{{ old('personal_equipment', optional(auth()->user()->profile)->personal_equipment ? implode(', ', json_decode(auth()->user()->profile->personal_equipment)) : '') }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">دوره‌های گذرانده‌شده (با کاما جدا شود)</label>
        <input type="text" name="completed_courses" class="form-control" value="{{ old('completed_courses', optional(auth()->user()->profile)->completed_courses ? implode(', ', json_decode(auth()->user()->profile->completed_courses)) : '') }}">
    </div>

    <h4 class="mt-4">مدارک</h4>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">آپلود کارت ملی</label>
            <input type="file" name="id_card_scan" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">آپلود عکس پرسنلی</label>
            <input type="file" name="profile_photo" class="form-control">
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-success">ذخیره</button>
    </div>
</form>

<!-- برای انتخاب تاریخ شمسی -->
<script src="https://cdn.jsdelivr.net/npm/@mdi/font/jsPersianDatepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/jsPersianDatepicker.min.css" rel="stylesheet" />

<script>
    $(document).ready(function () {
        $(".datepicker-jalali").persianDatepicker({
            format: 'YYYY/MM/DD'
        });
    });
</script>
