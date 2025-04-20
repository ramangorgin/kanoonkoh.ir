<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">اطلاعات کاربری</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" class="img-thumbnail mb-3" width="120" height="120">
                @else
                    <img src="{{ asset('assets/default-avatar.png') }}" class="img-thumbnail mb-3" width="120" height="120">
                @endif
            </div>
            <div class="col-md-9">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">نام: {{ $user->first_name }} {{ $user->last_name }}</li>
                    <li class="list-group-item">ایمیل: {{ $user->email }}</li>
                    <li class="list-group-item">کد ملی: {{ $user->national_id }}</li>
                    <li class="list-group-item">تاریخ تولد: {{ \Morilog\Jalali\Jalalian::fromDateTime($user->birth_date)->format('Y/m/d') }}</li>
                    <li class="list-group-item">تلفن: {{ $user->phone_number }}</li>
                    <li class="list-group-item">نوع عضویت: {{ $user->membership_type ?? 'نامشخص' }}</li>
                    <li class="list-group-item">امتیاز: {{ $user->score ?? 0 }}</li>
                    <li class="list-group-item">تاریخ عضویت: 
                        {{ $user->membership_date ? \Morilog\Jalali\Jalalian::fromDateTime($user->membership_date)->format('Y/m/d') : '—' }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
