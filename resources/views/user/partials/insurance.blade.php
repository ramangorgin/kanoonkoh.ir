@php use Morilog\Jalali\Jalalian; @endphp

<div>
    <h5 class="mb-3">ثبت بیمه ورزشی</h5>

    <form action="{{ route('insurance.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
            <label for="file">فایل بیمه (لطفاً فایل را انتخاب کنید)</label>
            <input type="text" id="jalali_expiration_date" class="form-control" required>
            <input type="hidden" name="expiration_date" id="expiration_date">
            <small class="text-muted">فرمت مجاز: pdf، jpg، png - حداکثر حجم: ۲ مگابایت</small>

            </div>
            <div class="col-md-6">
                <label>تاریخ انقضای بیمه</label>
                <input type="date" name="expiration_date" class="form-control" required>
            </div>
        </div>
        <button class="btn btn-primary mt-3">ثبت بیمه</button>
    </form>

    <h6 class="mb-3">سوابق بیمه‌های ثبت‌شده</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>تاریخ ثبت</th>
                <th>تاریخ انقضا</th>
                <th>فایل</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->sportInsurances ?? [] as $insurance)
                <tr>
                <td>{{ Jalalian::fromDateTime($insurance->created_at)->format('Y/m/d') }}</td>
                <td>{{ Jalalian::fromDateTime($insurance->expiration_date)->format('Y/m/d') }}</td>
                <td><a href="{{ asset('storage/' . $insurance->file_path) }}" target="_blank">مشاهده</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('scripts')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
@push('scripts')
<script>
$(document).ready(function () {
    $("#jalali_expiration_date").persianDatepicker({
        format: "YYYY-MM-DD",
        altField: "#expiration_date", // این مهم‌ترین بخشه
        altFormat: "gregorian",       // خروجی به میلادی
        observer: true,
        autoClose: true,
        initialValue: false
    });
});
</script>
@endpush

@endpush
