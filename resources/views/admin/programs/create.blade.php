@extends('layout')

@section('title', 'افزودن برنامه جدید')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">برنامه جدید</h2>

    <form action="{{ route('admin.programs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">عنوان برنامه</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">توضیحات</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">تاریخ اجرا</label>
            <input type="date" name="execution_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">نوع برنامه</label>
            <input type="text" name="type" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">منطقه</label>
            <input type="text" name="region" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">ارتفاع قله (در صورت وجود)</label>
            <input type="number" name="peak_altitude" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">وضعیت</label>
            <select name="status" class="form-control">
                <option value="پیش‌رو">پیش‌رو</option>
                <option value="انجام‌شده">انجام‌شده</option>
                <option value="لغو">لغو</option>
            </select>
        </div>

        <button class="btn btn-primary">ثبت برنامه</button>
    </form>
</div>
@endsection
