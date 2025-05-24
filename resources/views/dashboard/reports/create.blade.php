<h5 class="mb-3">ثبت گزارش جدید</h5>

<form action="{{ route('user.reports.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- نوع برنامه --}}
    <div class="mb-3">
        <label>نوع برنامه</label>
        <select name="type" class="form-select" required>
            <option value="کوهنوردی">کوهنوردی</option>
            <option value="طبیعت‌گردی">طبیعت‌گردی</option>
            <option value="فرهنگی">فرهنگی</option>
        </select>
    </div>

    {{-- انتخاب برنامه --}}
    <div class="mb-3">
        <label for="program_id" class="form-label">برنامه مرتبط</label>
        <select id="program_id" name="program_id" class="form-select" required>
            <option value="">انتخاب کنید</option>
            @foreach(App\Models\Program::all() as $program)
                <option value="{{ $program->id }}">{{ $program->title }}</option>
            @endforeach
        </select>
    </div>

    {{-- عنوان اتوماتیک --}}
    <div class="mb-3">
        <label for="title" class="form-label">عنوان گزارش</label>
        <input type="text" name="title" id="report_title" class="form-control" readonly required>
    </div>

    {{-- تاریخ شروع و پایان برنامه --}}
    <div class="row mb-3">
        <div class="col">
            <label for="start_date">تاریخ شروع</label>
            <input type="text" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="col">
            <label for="end_date">تاریخ پایان</label>
            <input type="text" name="end_date" id="end_date" class="form-control" required>
        </div>
    </div>

        {{-- سرپرست، کمک سرپرست، مسئول فنی، پشتیبان، راهنما --}}
    @foreach (['leader', 'assistant_leader', 'technical_manager', 'support', 'guide'] as $role)
        <div class="mb-3">
            <label for="{{ $role }}_id">{{ __("انتخاب " . __("roles.$role")) }}</label>
            <select name="{{ $role }}_id" id="{{ $role }}_id" class="form-select">
                <option value="">-- انتخاب کنید --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                @endforeach
            </select>
        </div>
    @endforeach

    {{-- ویژگی فنی --}}
    <div class="mb-3">
        <label>ویژگی فنی برنامه</label>
        <select name="technical_level" class="form-select" required>
            <option value="عمومی">عمومی</option>
            <option value="تخصصی">تخصصی</option>
        </select>
    </div>

    {{-- منطقه، ارتفاع، مسیر --}}
    <div class="mb-3">
        <label>منطقه جغرافیایی</label>
        <input type="text" name="area" class="form-control" required>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label>ارتفاع مبدا (متر)</label>
            <input type="number" name="start_altitude" class="form-control">
        </div>
        <div class="col-md-6">
            <label>ارتفاع قله (متر)</label>
            <input type="number" name="peak_height" class="form-control">
        </div>
    </div>

    {{-- شروع مسیر --}}
    <div class="mb-3">
        <label>محل شروع برنامه</label>
        <input type="text" name="start_location" class="form-control">
    </div>

    {{-- نوع جاده --}}
    <div class="mb-3">
        <label>نوع جاده</label>
        <select name="road_type" class="form-select">
            <option value="آسفالت">آسفالت</option>
            <option value="خاکی">خاکی</option>
        </select>
    </div>

    {{-- وضعیت حمل و نقل --}}
    <div class="mb-3">
        <label>حمل و نقل منطقه</label>
        <select name="transportation" class="form-select" multiple>
            <option>اتوبوس</option>
            <option>مینی‌بوس</option>
            <option>سواری</option>
        </select>
    </div>

    {{-- امکانات رفاهی --}}
    <div class="mb-3">
        <label>امکانات رفاهی منطقه</label>
        <select name="water_type" class="form-select" multiple>
            <option>آب لوله کشی</option>
            <option>چشمه فصلی</option>
            <option>چشمه دائم</option>
            <option>مدرسه</option>
            <option>برق</option>
            <option>تلفن</option>
            <option>پست</option>
            <option>آنتن‌دهی موبایل</option>
        </select>
    </div>

    {{-- وسایل فنی --}}
    <div class="mb-3">
        <label>وسایل فنی مورد نیاز</label>
        <select name="required_equipment[]" id="required_equipment" class="form-select" multiple>
            <option value="طناب">طناب</option>
            <option value="کلنگ یخ">کلنگ یخ</option>
            <option value="هارنس">هارنس</option>
            <option value="کرامپون">کرامپون</option>
            <option value="بیل برف">بیل برف</option>
        </select>
    </div>

    {{-- پیش‌نیازها --}}
    <div class="mb-3">
        <label>پیشنیازهای شرکت</label>
        <select name="required_skills[]" class="form-select" multiple>
            <option value="مدرک کوهپیمایی مقدماتی">مدرک کوهپیمایی مقدماتی</option>
            <option value="آشنایی با کار با طناب">آشنایی با کار با طناب</option>
            <option value="کار با یخ و برف">کار با یخ و برف</option>
        </select>
    </div>

        {{-- مشخصات طبیعی --}}
    <div class="row g-3">
        <div class="col-md-6">
            <label>پوشش گیاهی</label>
            <textarea name="natural_description" class="form-control" rows="2"></textarea>
        </div>

        <div class="col-md-6">
            <label>تنوع جانوری</label>
            <textarea name="wildlife" class="form-control" rows="2"></textarea>
        </div>

        <div class="col-md-6">
            <label>آب و هوای منطقه</label>
            <textarea name="weather" class="form-control" rows="2"></textarea>
        </div>

        <div class="col-md-3">
            <label>سرعت باد (کیلومتر بر ساعت)</label>
            <input type="number" name="wind_speed" class="form-control">
        </div>

        <div class="col-md-3">
            <label>دمای هوا (سانتی‌گراد)</label>
            <input type="number" name="temperature" class="form-control">
        </div>

        <div class="col-md-6">
            <label>زبان محلی</label>
            <input type="text" name="local_language" class="form-control">
        </div>

        <div class="col-md-6">
            <label>آثار باستانی و دیدنی‌ها</label>
            <textarea name="historical_sites" class="form-control" rows="2"></textarea>
        </div>

        <div class="col-md-6">
            <label>امکان تامین مواد غذایی</label>
            <textarea name="food_availability" class="form-control" rows="2"></textarea>
        </div>

        <div class="col-md-12">
            <label>ملاحظات و توضیحات ضروری</label>
            <textarea name="important_notes" class="form-control" rows="3"></textarea>
        </div>
    </div>

    <h5 class="mt-4">مسیر صعود و نقاط</h5>
<table class="table table-bordered" id="routePointsTable">
    <thead>
        <tr>
            <th>نام نقطه</th>
            <th>مختصات UTM</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<button type="button" class="btn btn-success btn-sm mb-3" onclick="addRoutePoint()">افزودن نقطه</button>

<h5 class="mt-4">زمانبندی اجرای برنامه</h5>
<table class="table table-bordered" id="executionScheduleTable">
    <thead>
        <tr>
            <th>نام رویداد</th>
            <th>زمان رویداد</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<button type="button" class="btn btn-success btn-sm mb-3" onclick="addExecutionEvent()">افزودن رویداد</button>

<div class="mb-4">
    <label>تعداد کل شرکت‌کنندگان</label>
    <input type="number" name="participant_count" class="form-control" required>
</div>

<h5 class="mt-4">مهمانان</h5>
<table class="table table-bordered" id="guestsTable">
    <thead>
        <tr>
            <th>نام مهمان</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<button type="button" class="btn btn-success btn-sm mb-3" onclick="addGuest()">افزودن مهمان</button>

<h5 class="mt-4">انتخاب اعضای شرکت‌کننده</h5>
<div class="mb-4">
    <label>اعضا</label>
    <select name="member_ids[]" id="member_ids" class="form-select" multiple>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>فایل کروکی مسیر (GPX/KML/KMZ)</label>
    <input type="file" name="track_file" class="form-control" accept=".gpx,.kml,.kmz">
</div>

<div class="mb-3">
    <label>گالری تصاویر برنامه (حداکثر ۱۰ عکس)</label>
    <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
</div>

<div class="mb-3">
    <label>متن کامل گزارش</label>
    <input id="full_report" type="hidden" name="full_report">
    <trix-editor input="full_report" class="form-control"></trix-editor>
</div>

<button type="submit" class="btn btn-primary mt-4">ثبت گزارش</button>
</form>

<script>
$(document).ready(function() {
    $("#start_date").persianDatepicker({
        format: 'YYYY/MM/DD',
        autoClose: true,
        initialValueType: 'persian',
    });

    $("#end_date").persianDatepicker({
        format: 'YYYY/MM/DD',
        autoClose: true,
        initialValueType: 'persian',
    });
});
</script>

<script>
$(document).ready(function() {
    $('#required_equipment').select2({
        tags: true,
        dir: "rtl",
        width: '100%',
        placeholder: "وسایل فنی را انتخاب یا اضافه کنید"
    });

    $('#required_skills').select2({
        tags: true,
        dir: "rtl",
        width: '100%',
        placeholder: "پیش‌نیازها را انتخاب یا اضافه کنید"
    });

    $('#member_ids').select2({
        dir: "rtl",
        width: '100%',
        placeholder: "اعضا را انتخاب کنید"
    });

    $('#leader_id, #assistant_leader_id, #technical_manager_id, #support_id, #guide_id').select2({
        dir: "rtl",
        width: '100%',
        placeholder: "انتخاب کنید"
    });
});
</script>

<script>
function addRoutePoint() {
    let table = document.getElementById('routePointsTable').getElementsByTagName('tbody')[0];
    let newRow = table.insertRow();
    newRow.innerHTML = `
        <td><input type="text" name="route_points[][point]" class="form-control" required></td>
        <td><input type="text" name="route_points[][utm]" class="form-control" required></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">حذف</button></td>
    `;
}

function addExecutionEvent() {
    let table = document.getElementById('executionScheduleTable').getElementsByTagName('tbody')[0];
    let newRow = table.insertRow();
    newRow.innerHTML = `
        <td><input type="text" name="execution_schedule[][event]" class="form-control" required></td>
        <td><input type="time" name="execution_schedule[][time]" class="form-control" required></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">حذف</button></td>
    `;
}

function addGuest() {
    let table = document.getElementById('guestsTable').getElementsByTagName('tbody')[0];
    let newRow = table.insertRow();
    newRow.innerHTML = `
        <td><input type="text" name="guests[]" class="form-control" required></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">حذف</button></td>
    `;
}

function deleteRow(button) {
    button.closest('tr').remove();
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const programSelect = document.getElementById('program_id');
    const titleField = document.getElementById('report_title');

    programSelect.addEventListener('change', function () {
        const selectedText = programSelect.options[programSelect.selectedIndex].text;
        if (selectedText) {
            titleField.value = `گزارش برنامه ${selectedText}`;
        } else {
            titleField.value = '';
        }
    });
});
</script>