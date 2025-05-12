<h5 class="mb-3">لیست دوره‌های گذرانده</h5>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>نام دوره</th>
            <th>نوع</th>
            <th>مرجع</th>
            <th>تاریخ</th>
            <th>وضعیت</th>
            <th>مدرک</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($courses as $course)
        <tr>
            <td>{{ $course->title }}</td>
            <td>{{ $course->type == 'internal' ? 'باشگاه' : 'شخصی' }}</td>
            <td>{{ $course->provider ?? 'باشگاه کانون کوه' }}</td>
            <td>
                {{ $course->date ? \Morilog\Jalali\Jalalian::fromDateTime($course->date)->format('Y/m/d') : '-' }}
            </td>
            <td>
                @if ($course->pivot->status == 'approved')
                    <span class="badge bg-success">تایید شده</span>
                @elseif ($course->pivot->status == 'pending')
                    <span class="badge bg-warning text-dark">در انتظار تایید</span>
                @else
                    <span class="badge bg-danger">رد شده</span>
                @endif
            </td>
            <td>
                @if ($course->pivot->certificate_file)
                    <a href="{{ asset('storage/' . $course->pivot->certificate_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">دانلود</a>
                @else
                    <span class="text-muted">ندارد</span>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-muted">هیچ دوره‌ای ثبت نشده است.</td></tr>
        @endforelse
    </tbody>
</table>

<hr class="my-4">

<h5 class="mb-3">درخواست برگزاری دوره</h5>

<form method="POST" action="{{ route('user.courses.request') }}">
    @csrf
    <div class="row">
        <div class="col-md-4 mb-3">
            <label>نام دوره</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>مرجع یا سازمان مدنظر</label>
            <input type="text" class="form-control" name="provider">
        </div>
        <div class="col-md-4 mb-3">
            <label>نام استاد پیشنهادی</label>
            <input type="text" class="form-control" name="teacher">
        </div>
        <div class="col-md-4 mb-3">
            <label>تاریخ پیشنهادی (شمسی)</label>
            <input type="text" class="form-control datepicker" name="suggested_date">
        </div>
    </div>
    <button type="submit" class="btn btn-outline-success">ارسال درخواست</button>
</form>
