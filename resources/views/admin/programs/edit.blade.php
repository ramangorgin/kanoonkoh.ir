@extends('layouts.app')

@section('title', 'ویرایش برنامه: ' . $program->title)

@section('content')
<div class="container">
    <h4 class="mb-4">ویرایش برنامه {{ $program->title }}</h4>

    <form action="{{ route('admin.programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- عنوان و منطقه --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label>عنوان برنامه</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $program->title) }}" required>
            </div>
            <div class="col-md-6">
                <label>منطقه</label>
                <input type="text" name="region" class="form-control" value="{{ old('region', $program->region) }}" required>
            </div>
        </div>

        {{-- توضیح --}}
        <div class="mb-3">
            <label>توضیحات</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $program->description) }}</textarea>
        </div>

        {{-- نوع، سختی، ارتفاع --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <label>نوع برنامه</label>
                <select name="type" class="form-select">
                    @foreach(['کوهنوردی سنگین', 'کوهنوردی متوسط', 'کوهنوردی سبک', 'طبیعت‌گردی', 'برنامه فرهنگی', 'سنگ نوردی'] as $type)
                        <option value="{{ $type }}" {{ $program->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>سختی برنامه</label>
                <select name="difficulty_level" class="form-select">
                    @foreach(['آسان', 'متوسط', 'سخت'] as $level)
                        <option value="{{ $level }}" {{ $program->difficulty_level == $level ? 'selected' : '' }}>{{ $level }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>ارتفاع قله</label>
                <input type="number" name="peak_altitude" class="form-control" value="{{ old('peak_altitude', $program->peak_altitude) }}">
            </div>
        </div>

        {{-- تاریخ اجرا، مهلت ثبت‌نام، ظرفیت --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <label>تاریخ اجرا</label>
                <input type="date" name="execution_date" class="form-control" value="{{ old('execution_date', $program->execution_date) }}">
            </div>
            <div class="col-md-4">
                <label>مهلت ثبت‌نام</label>
                <input type="datetime-local" name="registration_deadline" class="form-control" value="{{ old('registration_deadline', \Carbon\Carbon::parse($program->registration_deadline)->format('Y-m-d\TH:i')) }}">
            </div>
            <div class="col-md-4">
                <label>ظرفیت</label>
                <input type="number" name="max_participants" class="form-control" value="{{ old('max_participants', $program->max_participants) }}">
            </div>
        </div>

        {{-- وضعیت‌ها --}}
        <div class="row mb-3">
            @foreach([
                'is_registration_open' => 'ثبت‌نام باز است',
                'is_free' => 'برنامه رایگان است',
                'has_transport' => 'حمل‌ونقل گروهی دارد',
                'has_insurance_required' => 'بیمه اجباری است'
            ] as $field => $label)
                <div class="col-md-3">
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" name="{{ $field }}" {{ $program->$field ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $label }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- مسئولین --}}
        <div class="row mb-3">
            @foreach([
                'leader_id' => 'سرپرست',
                'assistant_leader_id' => 'کمک‌سرپرست',
                'technical_manager_id' => 'مسئول فنی',
                'guide_id' => 'راهنما'
            ] as $field => $label)
                <div class="col-md-3">
                    <label>{{ $label }}</label>
                    <select name="{{ $field }}" class="form-select">
                        <option value="">—</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $program->$field == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>

        {{-- اطلاعات حرکت تهران و کرج --}}
        @foreach(['tehran' => 'تهران', 'karaj' => 'کرج'] as $key => $label)
            <fieldset class="border p-3 mb-3 rounded">
                <legend class="small text-muted">حرکت از {{ $label }}</legend>
                <div class="row">
                    <div class="col-md-4">
                        <label>تاریخ</label>
                        <input type="date" name="departure_date_{{ $key }}" class="form-control" value="{{ old("departure_date_$key", $program->{"departure_date_$key"}) }}">
                    </div>
                    <div class="col-md-4">
                        <label>ساعت</label>
                        <input type="time" name="departure_time_{{ $key }}" class="form-control" value="{{ old("departure_time_$key", $program->{"departure_time_$key"}) }}">
                    </div>
                    <div class="col-md-4">
                        <label>محل</label>
                        <input type="text" name="departure_place_{{ $key }}" class="form-control" value="{{ old("departure_place_$key", $program->{"departure_place_$key"}) }}">
                    </div>
                    <div class="col-md-6">
                        <label>عرض جغرافیایی</label>
                        <input type="text" name="departure_lat_{{ $key }}" class="form-control" value="{{ old("departure_lat_$key", $program->{"departure_lat_$key"}) }}">
                    </div>
                    <div class="col-md-6">
                        <label>طول جغرافیایی</label>
                        <input type="text" name="departure_lon_{{ $key }}" class="form-control" value="{{ old("departure_lon_$key", $program->{"departure_lon_$key"}) }}">
                    </div>
                </div>
            </fieldset>
        @endforeach

        {{-- هزینه و بانک --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <label>هزینه اعضا</label>
                <input type="number" name="member_cost" class="form-control" value="{{ old('member_cost', $program->member_cost) }}">
            </div>
            <div class="col-md-4">
                <label>هزینه مهمان</label>
                <input type="number" name="guest_cost" class="form-control" value="{{ old('guest_cost', $program->guest_cost) }}">
            </div>
            <div class="col-md-4">
                <label>شماره کارت</label>
                <input type="text" name="card_number" class="form-control" value="{{ old('card_number', $program->card_number) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>شماره شبا</label>
                <input type="text" name="sheba_number" class="form-control" value="{{ old('sheba_number', $program->sheba_number) }}">
            </div>
            <div class="col-md-4">
                <label>نام صاحب کارت</label>
                <input type="text" name="card_holder" class="form-control" value="{{ old('card_holder', $program->card_holder) }}">
            </div>
            <div class="col-md-4">
                <label>نام بانک</label>
                <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name', $program->bank_name) }}">
            </div>
        </div>

        {{-- سایر فیلدها --}}
        <div class="mb-3">
            <label>تجهیزات مورد نیاز</label>
            <textarea name="required_equipment" class="form-control">{{ old('required_equipment', $program->required_equipment) }}</textarea>
        </div>
        <div class="mb-3">
            <label>وعده‌های غذایی</label>
            <textarea name="required_meals" class="form-control">{{ old('required_meals', $program->required_meals) }}</textarea>
        </div>
        <div class="mb-3">
            <label>یادداشت مهم</label>
            <textarea name="important_alert" class="form-control">{{ old('important_alert', $program->important_alert) }}</textarea>
        </div>

        {{-- عکس کاور --}}
        <div class="mb-3">
            <label>عکس کاور</label>
            <input type="file" name="cover_image" class="form-control">
            @if($program->cover_image)
                <img src="{{ asset('storage/' . $program->cover_image) }}" class="mt-2 rounded" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
    </form>
</div>
@endsection
