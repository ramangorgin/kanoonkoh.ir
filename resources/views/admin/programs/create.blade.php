@extends('layouts.app')

@section('title', 'ایجاد برنامه جدید')

@section('content')
<div class="container">
    <h4 class="mb-4">ایجاد برنامه جدید</h4>

    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- عنوان، توضیح، منطقه --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label>عنوان برنامه</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>منطقه</label>
                <input type="text" name="region" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>توضیحات</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        {{-- نوع، سطح سختی، ارتفاع قله --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <label>نوع برنامه</label>
                <select name="type" class="form-select" required>
                    <option>کوهنوردی سنگین</option>
                    <option>کوهنوردی متوسط</option>
                    <option>کوهنوردی سبک</option>
                    <option>طبیعت‌گردی</option>
                    <option>برنامه فرهنگی</option>
                    <option>سنگ نوردی</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>سطح سختی</label>
                <select name="difficulty_level" class="form-select">
                    <option>آسان</option>
                    <option>متوسط</option>
                    <option>سخت</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>ارتفاع قله (متر)</label>
                <input type="number" name="peak_altitude" class="form-control">
            </div>
        </div>

        {{-- تاریخ اجرا، مهلت ثبت‌نام، ظرفیت --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <label>تاریخ اجرا</label>
                <input type="date" name="execution_date" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>مهلت ثبت‌نام</label>
                <input type="datetime-local" name="registration_deadline" class="form-control">
            </div>
            <div class="col-md-4">
                <label>حداکثر ظرفیت</label>
                <input type="number" name="max_participants" class="form-control">
            </div>
        </div>

        {{-- وضعیت‌های بولی --}}
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-check mt-4">
                    <input type="checkbox" name="is_registration_open" class="form-check-input" checked>
                    <label class="form-check-label">ثبت‌نام باز است</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check mt-4">
                    <input type="checkbox" name="is_free" class="form-check-input">
                    <label class="form-check-label">برنامه رایگان است</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check mt-4">
                    <input type="checkbox" name="has_transport" class="form-check-input" checked>
                    <label class="form-check-label">حمل‌ونقل گروهی دارد</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check mt-4">
                    <input type="checkbox" name="has_insurance_required" class="form-check-input">
                    <label class="form-check-label">بیمه اجباری است</label>
                </div>
            </div>
        </div>

        {{-- سرپرستان --}}
        <div class="row mb-3">
            <div class="col-md-3">
                <label>سرپرست</label>
                <select name="leader_id" class="form-select">
                    <option value="">—</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>کمک‌سرپرست</label>
                <select name="assistant_leader_id" class="form-select">
                    <option value="">—</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>مسئول فنی</label>
                <select name="technical_manager_id" class="form-select">
                    <option value="">—</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>راهنما</label>
                <select name="guide_id" class="form-select">
                    <option value="">—</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- حرکت تهران و کرج --}}
        @foreach(['tehran' => 'تهران', 'karaj' => 'کرج'] as $key => $label)
            <fieldset class="border p-3 mb-3 rounded">
                <legend class="small text-muted">حرکت از {{ $label }}</legend>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>تاریخ</label>
                        <input type="date" name="departure_date_{{ $key }}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>ساعت</label>
                        <input type="time" name="departure_time_{{ $key }}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>محل</label>
                        <input type="text" name="departure_place_{{ $key }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>عرض جغرافیایی</label>
                        <input type="text" name="departure_lat_{{ $key }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>طول جغرافیایی</label>
                        <input type="text" name="departure_lon_{{ $key }}" class="form-control">
                    </div>
                </div>
            </fieldset>
        @endforeach

        {{-- هزینه‌ها، اطلاعات بانکی --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <label>هزینه اعضا (تومان)</label>
                <input type="number" name="member_cost" class="form-control">
            </div>
            <div class="col-md-4">
                <label>هزینه مهمان (تومان)</label>
                <input type="number" name="guest_cost" class="form-control">
            </div>
            <div class="col-md-4">
                <label>شماره کارت</label>
                <input type="text" name="card_number" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>شماره شبا</label>
                <input type="text" name="sheba_number" class="form-control">
            </div>
            <div class="col-md-4">
                <label>صاحب کارت</label>
                <input type="text" name="card_holder" class="form-control">
            </div>
            <div class="col-md-4">
                <label>نام بانک</label>
                <input type="text" name="bank_name" class="form-control">
            </div>
        </div>

        {{-- تجهیزات، وعده‌ها، هشدارها --}}
        <div class="mb-3">
            <label>تجهیزات مورد نیاز</label>
            <textarea name="required_equipment" class="form-control" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <label>وعده‌های غذایی مورد نیاز</label>
            <textarea name="required_meals" class="form-control" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <label>اطلاعیه یا هشدار مهم</label>
            <textarea name="important_alert" class="form-control" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <label>یادداشت درباره زمان حرکت</label>
            <input type="text" name="meeting_time_note" class="form-control">
        </div>
        <div class="mb-3">
            <label>توضیح برای فرم ثبت‌نام</label>
            <textarea name="registration_notes" class="form-control" rows="2"></textarea>
        </div>

        {{-- عکس کاور --}}
        <div class="mb-3">
            <label>عکس کاور برنامه</label>
            <input type="file" name="cover_image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">ایجاد برنامه</button>
    </form>
</div>
@endsection
