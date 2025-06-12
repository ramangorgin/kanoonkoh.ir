@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.programs.index') }}">برنامه‌ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش برنامه</li>
        </ol>
    </nav>
@endsection

@section('content')
    <h3>ویرایش برنامه</h3>

    <div class="container mt-4">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.programs.update', $program->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label>عنوان برنامه</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title', $program->title) }}">
        </div>

        <div class="row">
            <div class="form-group col">
                <label>تاریخ شروع برنامه</label>
                <input type="text" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $program->start_date) }}">
                </div>
            <div class="form-group col">
                <label>تاریخ پایان برنامه</label>
                <input type="text" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $program->end_date) }}">
                </div>
        </div>


        {{-- مسئولین --}}
        <hr>
        <div class="card mt-4 shadow-sm border">
            <div class="card-header bg-light">
                <h5 class="mb-0">🔰 مسئولین برنامه</h5>
            </div>

            <div class="card-body">
                <p class="text-muted mb-3">
                    لطفاً برای هر مسئول، نوع سمت (مثلاً سرپرست، پزشک، مترجم) را وارد کرده و سپس فرد مربوطه را انتخاب کنید.
                </p>

                <div id="roles-container">
                <div class="row align-items-center mb-3 role-item">
                        <div class="col-md-3">
                            <input type="text" name="roles[0][role_title]" class="form-control" placeholder="سمت (مثلاً راهنما)" value="{{ old('roles[0][role_title]', $program->roles[0][role_title]) }}">
                        </div>

                        <div class="col-md-4">
                            <select name="roles[0][user_id]" class="form-control" value="{{ old('roles[0][user_id]', $program->roles[0][user_id]) }}">
                                <option value="">-- انتخاب کاربر از لیست --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="roles[0][custom_name]" class="form-control" placeholder="یا نوشتن نام دلخواه (مثلاً آقای دکتر...)" value="{{ old('roles[0][custom_name]', $program->roles[0][custom_name]) }}">
                        </div>

                        <div class="col-md-1 text-end">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRole(this)"><i class="bi bi-x-square-fill"></i></button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-primary mt-2" onclick="addRole()">➕ افزودن مسئول دیگر</button>
            </div>
        </div>



        <hr>
        {{-- حمل و نقل --}}
        <div class="mb-2">
            <label>آیا حمل و نقل دارد؟</label>
            <select name="has_transport" id="has_transport" class="form-control" value="{{ old('has_transport', $program->has_transport) }}">
                <option value="1" {{ old('has_transport', $program->has_transport) == 1 ? 'selected' : '' }}>بله</option>
                <option value="0" {{ old('has_transport', $program->has_transport) == 0 ? 'selected' : '' }}>خیر</option>
            </select>
        </div>

        <div class="transport-fields">
            <div id="transport_fields">
                {{-- تهران --}}
                <hr>
                <h5 class="mt-3 mb-3">حرکت از تهران</h5>
                <div class="mb-2">
                    <label>ساعت و حرکت حرکت</label>
                    <input type="text" name="departure_tehran_datetime" id="departure_tehran_datetime" class="form-control" placeholder="تاریخ و ساعت حرکت از تهران" value="{{ old('departure_tehran_datetime', $program->departure_tehran_datetime) }}">
                    </div>
                <div class="mb-2">
                    <label>محل حرکت</label>
                    <input type="text" name="departure_place_tehran" class="form-control" value="{{ old('departure_place_tehran', $program->departure_place_tehran) }}">
                </div>
                <div class="mb-2">
                    <label>موقعیت روی نقشه</label>
                    <div id="map_tehran" style="height: 300px;"></div>
                    <input type="hidden" name="departure_lat_tehran" id="departure_lat_tehran" value="{{ old('departure_lat_tehran', $program->departure_lat_tehran) }}">
                    <input type="hidden" name="departure_lon_tehran" id="departure_lon_tehran" value="{{ old('departure_lon_tehran', $program->departure_lon_tehran) }}">
                </div>

                {{-- کرج --}}
                <hr>
                <h5 class="mt-3 mb-3">حرکت از کرج</h5>
                <div class="mb-2">
                    <label>ساعت و حرکت حرکت</label>
                    <input type="text" name="departure_karaj_datetime" id="departure_karaj_datetime" class="form-control" placeholder="تاریخ و ساعت حرکت از کرج" value="{{ old('departure_karaj_datetime', $program->departure_karaj_datetime) }}">
                    </div>
                <div class="mb-2">
                    <label>محل حرکت</label>
                    <input type="text" name="departure_place_karaj" class="form-control" value="{{ old('departure_place_karaj', $program->departure_place_karaj) }}">
                </div>
                <div class="mb-2">
                    <label>موقعیت روی نقشه</label>
                    <div id="map_karaj" style="height: 300px;"></div>
                    <input type="hidden" name="departure_lat_karaj" id="departure_lat_karaj" value="{{ old('departure_lat_karaj', $program->departure_lat_karaj) }}">
                    <input type="hidden" name="departure_lon_karaj" id="departure_lon_karaj" value="{{ old('departure_lon_karaj', $program->departure_lon_karaj) }}">
                </div>
            </div>

        </div>

        <div>
            <hr>
            <h5 class="mb-3" >ضروریات</h5>
        {{-- تجهیزات --}}
        <div class="mb-2">
            <label>تجهیزات مورد نیاز</label>
            <select name="required_equipment[]" class="form-select select2-tags" multiple>
                @php
                    $equipmentOptions = ['هدلامپ', 'زیرانداز', 'قمقمه آب', 'کفش کوهنوردی'];
                    $selectedEquipments = explode(',', $program->required_equipment ?? '');
                @endphp
                @foreach ($equipmentOptions as $item)
                    <option value="{{ $item }}" {{ in_array($item, $selectedEquipments) ? 'selected' : '' }}>
                        {{ $item }}
                    </option>
                @endforeach
            </select>

        </div>

        {{-- وعده‌ها --}}
        <div class="mb-2">
            <label>وعده‌های مورد نیاز</label>
            @foreach(['صبحانه', 'ناهار', 'شام', 'میانوعده'] as $meal)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="required_meals[]" value="{{ $meal }}" id="meal_{{ $meal }}" value="{{ old('required_meals[]', $program->required_meals[]) }}">
                    <label class="form-check-label" for="meal_{{ $meal }}">{{ $meal }}</label>
                </div>
            @endforeach
        </div>
            </div>
        <div>
            <hr>
            <h5 class="mb-3" >هزینه</h5>
        
            {{-- رایگان بودن --}}
            <div class="mb-2">
                <label>آیا برنامه رایگان است؟</label>
                <select name="is_free" id="is_free" class="form-control" value="{{ old('is_free', $program->is_free) }}">
                    <option value="0" {{ old('has_transport', $program->has_transport) == 0 ? 'selected' : '' }}>خیر</option>
                    <option value="1" {{ old('has_transport', $program->has_transport) == 1 ? 'selected' : '' }}>بله</option>
                </select>
            </div>

            <div class="payment-fields">
                <div class="row">
                    <div class="col-md-6">
                        <label>هزینه برای اعضا</label>
                        <div class="input-group">
                            <input type="number" name="member_cost" class="form-control" value="{{ old('member_cost', $program->member_cost) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">ریال</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>هزینه برای مهمان</label>
                        <div class="input-group">
                            <input type="number" name="guest_cost" class="form-control" value="{{ old('guest_cost', $program->guest_cost) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">ریال</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <hr>
                    <h5>اطلاعات کارت بانکی</h5>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>شماره کارت</label>
                            <input type="text" name="card_number" class="form-control" value="{{ old('card_number', $program->card_number) }}">
                        </div>
                        <div class="col-md-6">
                            <label>شماره شبا</label>
                            <input type="text" name="sheba_number" class="form-control" value="{{ old('sheba_number', $program->sheba_number) }}">
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>نام دارنده کارت</label>
                            <input type="text" name="card_holder" class="form-control" value="{{ old('card_holder', $program->card_holder) }}">
                        </div>
                        <div class="col-md-6">
                                <label>نام بانک</label>
                                <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name', $program->bank_name) }}">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div>
            <hr>
            <h5 class="mb-3">ثبت‌نام</h5>
            <div class="row">
                <div class="col-md-6">
                    <label>ثبت‌نام باز است؟</label>
                    <select name="is_registration_open" id="is_registration_open" class="form-control" value="{{ old('is_registration_open', $program->is_registration_open) }}">
                        <option value="1" {{ old('has_transport', $program->has_transport) == 1 ? 'selected' : '' }}>بله</option>
                        <option value="0" {{ old('has_transport', $program->has_transport) == 0 ? 'selected' : '' }}>خیر</option>
                    </select>
                </div>

                <div class="col-md-6" id="registration_section">
                    <label>مهلت ثبت‌نام</label>
                    <input type="text" name="registration_deadline" id="registration_deadline" class="form-control" value="{{ old('registration_deadline', $program->registration_deadline) }}">
                </div>
            </div>
        </div>
        <div>
            <hr>
            <h5 class="mb-3">توضیحات و تصاویر</h5>
            {{-- آپلود عکس --}}
            <div class="mb-2">
                <label>آپلود عکس‌های برنامه (حداکثر ۱۰ عدد)</label>
                <input type="file" name="photos[]" class="form-control" multiple accept="image/*" value="{{ old('photos[]', $program->photos[]) }}">
            </div>

            {{-- توضیحات --}}
            <div class="mb-2">
                <label>توضیحات</label>
                <textarea name="description" id="description" class="form-control" rows="10" value="{{ old('description', $program->description) }}"></textarea>
            </div>
        </div>

        <button class="btn btn-success" style="width: 100%;">ثبت برنامه</button>
    </form>
</div>

@push('scripts')
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description'), { language: 'fa' })
        .catch(error => console.error(error));
</script>

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({ dir: "rtl", width: '100%' });
        $('.select2-tags').select2({ tags: true, dir: "rtl", width: '100%' });

        $('#equipments, #meals').select2({
            tags: true,
            multiple: true,
            placeholder: 'انتخاب یا افزودن مورد جدید...',
            dir: "rtl"
        });

        // حمل و نقل
        function toggleTransportFields() {
            const value = $('#has_transport').val();
            if (value === '1') {
                $('.transport-fields').show();
            } else {
                $('.transport-fields').hide();
            }
        }

        // رایگان بودن
        function togglePaymentFields() {
            const value = $('#is_free').val();
            if (value === '0') {
                $('.payment-fields').show();
            } else {
                $('.payment-fields').hide();
            }
        }

        // اجرا هنگام بارگذاری
        toggleTransportFields();
        togglePaymentFields();

        // تغییرات کاربر
        $('#has_transport').on('change', toggleTransportFields);
        $('#is_free').on('change', togglePaymentFields);

        // تاریخ‌های شمسی + زمان
        $('#start_date, #end_date').persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValue: false,
            autoClose: true,
            observer: true,
            calendarType: 'persian',
            navigator: {
                enabled: true,
                scroll: { enabled: false },
                text: { btnNextText: ">", btnPrevText: "<" }
            }
        });

        $('#departure_tehran_datetime, #departure_karaj_datetime').persianDatepicker({
            format: 'YYYY/MM/DD HH:mm',
            initialValue: false,
            autoClose: true,
            observer: true,
            calendarType: 'persian',
            timePicker: { enabled: true, meridiem: { enabled: false } }
        });

        $('#registration_deadline').persianDatepicker({
            format: 'YYYY/MM/DD HH:mm',
            initialValue: false,
            autoClose: true,
            observer: true,
            calendarType: 'persian',
            timePicker: { enabled: true, meridiem: { enabled: false } }
        });

        // Leaflet Maps
        function initMap(divId, latInputId, lonInputId) {
            const map = L.map(divId).setView([35.7, 51.4], 9);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18
            }).addTo(map);

            let marker;
            map.on('click', function (e) {
                const { lat, lng } = e.latlng;
                document.getElementById(latInputId).value = lat;
                document.getElementById(lonInputId).value = lng;

                if (marker) map.removeLayer(marker);
                marker = L.marker(e.latlng).addTo(map);
            });
        }

        initMap('map_tehran', 'departure_lat_tehran', 'departure_lon_tehran');
        initMap('map_karaj', 'departure_lat_karaj', 'departure_lon_karaj');
    });

    // افزودن مسئول جدید
    let roleIndex = 1;
    function addRole() {
        const container = document.getElementById('roles-container');
        const html = `
        <div class="row align-items-center mb-3 role-item">
            <div class="col-md-3">
                <input type="text" name="roles[${roleIndex}][role_title]" class="form-control" placeholder="سمت (مثلاً راهنما)" value="{{ old('roles[${roleIndex}][role_title]', $program->roles[${roleIndex}][role_title]) }}">
            </div>
            <div class="col-md-4">
                <select name="roles[${roleIndex}][user_id]" class="form-control" value="{{ old('roles[${roleIndex}][user_id]', $program->roles[${roleIndex}][user_id]) }}">
                    <option value="">-- انتخاب کاربر از لیست --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="roles[${roleIndex}][custom_name]" class="form-control" placeholder="یا وارد کردن نام دلخواه" value="{{ old('roles[${roleIndex}][custom_name]', $program->roles[${roleIndex}][custom_name]) }}">
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeRole(this)">×</button>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        roleIndex++;
    }

    function removeRole(button) {
        button.closest('.role-item').remove();
    }
</script>
@endpush

@endsection