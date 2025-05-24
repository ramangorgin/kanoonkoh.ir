{{-- هزینه‌ها و اطلاعات بانکی --}}
@if(!$program->is_free)
<div class="mb-4">
    <h5>هزینه ثبت‌نام:</h5>
    <p>برای اعضا: {{ number_format($program->member_cost) }} تومان</p>
    <p>برای مهمانان: {{ number_format($program->guest_cost) }} تومان</p>
    <h6 class="mt-3">اطلاعات واریز:</h6>
    <p>
        شماره کارت: {{ $program->card_number }} <br>
        شبا: {{ $program->sheba_number }} <br>
        صاحب کارت: {{ $program->card_holder }} ({{ $program->bank_name }})
    </p>
</div>
@endif

@if($program->is_registration_open && $program->registration_deadline > now())
<div id="confirm_section">
    <h4 class="mb-3">آیا مایل به ثبت‌نام در این برنامه هستید؟</h4>
    <button type="button" id="confirm_button" class="btn btn-primary">بله، ادامه ثبت‌نام</button>
</div>

<div id="register_form_section" class="mt-5 d-none">
    <h4 class="mb-3">فرم ثبت‌نام در برنامه</h4>

    <form action="{{ route('user.programs.register', $program->id) }}" method="POST">
        @csrf

        @guest
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>نام و نام خانوادگی</label>
                <input type="text" name="guest_name" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>شماره تلفن</label>
                <input type="text" name="guest_phone" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>کد ملی</label>
                <input type="text" name="guest_national_id" class="form-control" required>
            </div>
        </div>
        @endguest

        @if($program->has_transport)
        <div class="mb-3">
            <label>محل سوار شدن</label>
            <select name="pickup_location" class="form-select" required>
                <option value="تهران">تهران</option>
                <option value="کرج">کرج</option>
            </select>
        </div>
        @endif

        @if(!$program->is_free)
        <div class="mb-3">
            <label>کد پیگیری تراکنش پرداخت</label>
            <input type="text" name="transaction_code" class="form-control" required>
        </div>
        @endif

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="agree" required>
            <label class="form-check-label">
                با <a href="{{ route('rules') }}" target="_blank">قوانین و مقررات</a> موافقم.
            </label>
        </div>
        <p>
            ثبت‌نام در برنامه به منزله پذیرش
            <a href="{{ route('conditions') }}" target="_blank">شرایط عضویت</a>
            می‌باشد.
        </p>
        <button type="submit" class="btn btn-success">ثبت‌نام</button>
    </form>
</div>
@else
<div class="alert alert-warning text-center">ثبت‌نام برای این برنامه بسته شده است.</div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const confirmBtn = document.getElementById('confirm_button');
    const confirmSection = document.getElementById('confirm_section');
    const formSection = document.getElementById('register_form_section');
    if (confirmBtn && confirmSection && formSection) {
        confirmBtn.addEventListener('click', function () {
            confirmSection.classList.add('d-none');
            formSection.classList.remove('d-none');
        });
    }
});
</script>
@endpush
