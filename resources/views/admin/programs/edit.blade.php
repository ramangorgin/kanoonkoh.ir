@extends('layout')

@section('title', 'ویرایش برنامه')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">ویرایش برنامه</h2>

    <form action="{{ route('admin.programs.update', $program) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">عنوان برنامه</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $program->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">توضیحات</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $program->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">تاریخ اجرا</label>
            <input type="date" name="execution_date" class="form-control" value="{{ old('execution_date', $program->execution_date) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">نوع برنامه</label>
            <select name="type" class="form-select">
                <option value="کوهنوردی" @selected($program->type == 'کوهنوردی')>کوهنوردی</option>
                <option value="سنگ‌نوردی" @selected($program->type == 'سنگ‌نوردی')>سنگ‌نوردی</option>
                <option value="طبیعت‌گردی" @selected($program->type == 'طبیعت‌گردی')>طبیعت‌گردی</option>
                <option value="برنامه فرهنگی" @selected($program->type == 'برنامه فرهنگی')>برنامه فرهنگی</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">منطقه</label>
            <input type="text" name="region" class="form-control" value="{{ old('region', $program->region) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">ارتفاع قله (در صورت وجود)</label>
            <input type="number" name="peak_altitude" class="form-control" value="{{ old('peak_altitude', $program->peak_altitude) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">هزینه برای اعضا</label>
            <input type="number" name="member_cost" class="form-control" value="{{ old('member_cost', $program->member_cost) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">هزینه برای میهمان</label>
            <input type="number" name="guest_cost" class="form-control" value="{{ old('guest_cost', $program->guest_cost) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">تجهیزات مورد نیاز</label>
            <textarea name="required_equipment" class="form-control" rows="2">{{ old('required_equipment', $program->required_equipment) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">وعده‌های غذایی مورد نیاز</label>
            <input type="text" name="required_meals" class="form-control" value="{{ old('required_meals', $program->required_meals) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">تصویر شاخص (نام فایل)</label>
            <input type="text" name="cover_image" class="form-control" value="{{ old('cover_image', $program->cover_image) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">وضعیت</label>
            <select name="status" class="form-select">
                <option value="پیش‌رو" @selected($program->status == 'پیش‌رو')>پیش‌رو</option>
                <option value="انجام‌شده" @selected($program->status == 'انجام‌شده')>انجام‌شده</option>
                <option value="لغوشده" @selected($program->status == 'لغوشده')>لغوشده</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">ذخیره تغییرات</button>
    </form>
</div>
@endsection
