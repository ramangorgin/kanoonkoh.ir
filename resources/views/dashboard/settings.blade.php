{{-- resources/views/dashboard/settings.blade.php --}}
<h5 class="mb-3">تنظیمات حساب کاربری</h5>

<form method="POST" action="{{ route('dashboard.settings.updatePassword') }}">
    @csrf

    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label">رمز عبور فعلی</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">رمز عبور جدید</label>
            <input type="password" name="new_password" class="form-control" required minlength="6">
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">تکرار رمز عبور جدید</label>
            <input type="password" name="new_password_confirmation" class="form-control" required minlength="6">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
</form>
