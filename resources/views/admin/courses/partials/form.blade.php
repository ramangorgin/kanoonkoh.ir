@php
    $c = $course ?? null;
@endphp

<div class="mb-3">
    <label class="form-label">عنوان دوره</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $c?->title) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">نوع دوره</label>
    <input type="text" name="type" class="form-control" value="{{ old('type', $c?->type) }}">
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">مرجع برگزارکننده</label>
        <input type="text" name="provider" class="form-control" value="{{ old('provider', $c?->provider) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">مدرس</label>
        <input type="text" name="instructor" class="form-control" value="{{ old('instructor', $c?->instructor) }}">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">از تاریخ</label>
        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $c?->start_date) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">تا تاریخ</label>
        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $c?->end_date) }}">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">از ساعت</label>
        <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $c?->start_time) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">تا ساعت</label>
        <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $c?->end_time) }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">نام مکان</label>
    <input type="text" name="location_name" class="form-control" value="{{ old('location_name', $c?->location_name) }}">
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">عرض جغرافیایی</label>
        <input type="text" name="lat" class="form-control" value="{{ old('lat', $c?->lat) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">طول جغرافیایی</label>
        <input type="text" name="lon" class="form-control" value="{{ old('lon', $c?->lon) }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">پیش‌نیازها</label>
    <textarea name="requirements" class="form-control">{{ old('requirements', $c?->requirements) }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">توضیحات برای شرکت‌کنندگان</label>
    <textarea name="notes_for_participants" class="form-control">{{ old('notes_for_participants', $c?->notes_for_participants) }}</textarea>
</div>

<div class="form-check mt-3">
    <input class="form-check-input" type="checkbox" name="is_free" id="is_free">
    <label class="form-check-label" for="is_free">این دوره رایگان است</label>
</div>


<h5 class="mt-4">اطلاعات واریز هزینه</h5>
<div class="row mb-3">
    <div class="col-md-4">
        <label>هزینه اعضا (تومان)</label>
        <input type="number" name="member_cost" class="form-control">
    </div>
    <div class="col-md-4">
        <label>هزینه مهمان (تومان)</label>
        <input type="number" name="guest_cost" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label>شماره کارت</label>
        <input type="text" name="card_number" class="form-control">
    </div>
    <div class="col-md-4">
        <label>شماره شبا</label>
        <input type="text" name="sheba_number" class="form-control">
    </div>
    <div class="col-md-4">
        <label>نام صاحب کارت</label>
        <input type="text" name="card_holder" class="form-control">
    </div>
</div>


<div class="mb-3">
    <label class="form-label">تصویر کاور</label>
    <input type="file" name="cover_image" class="form-control">
    @if($c?->cover_image)
        <img src="{{ asset('storage/' . $c->cover_image) }}" class="mt-2" width="150">
    @endif
</div>
