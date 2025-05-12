<h5 class="mb-3">برنامه‌های شرکت‌کرده</h5>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>عنوان</th>
            <th>تاریخ</th>
            <th>منطقه</th>
            <th>سرپرست</th>
            <th>گزارش</th>
        </tr>
    </thead>
    <tbody>
        @forelse(auth()->user()->programs as $program)
            <tr>
                <td>{{ $program->title }}</td>
                <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($program->date)->format('Y/m/d') }}</td>
                <td>{{ $program->region }}</td>
                <td>{{ $program->leader }}</td>
                <td>
                    @if($program->report)
                        <a href="{{ route('program.report.show', $program->report->id) }}" class="btn btn-sm btn-primary">مشاهده</a>
                    @else
                        <span class="text-muted">ندارد</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">برنامه‌ای ثبت نشده است.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<hr class="my-4">

<h5 class="mb-3">پیشنهاد برنامه جدید</h5>

<form method="POST" action="{{ route('user.programs.request') }}">
    @csrf
    <div class="row">
        <div class="col-md-4 mb-3">
            <label>عنوان برنامه</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>منطقه پیشنهادی</label>
            <input type="text" class="form-control" name="region" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>سرپرست پیشنهادی</label>
            <input type="text" class="form-control" name="leader">
        </div>
        <div class="col-md-4 mb-3">
            <label>تاریخ پیشنهادی (شمسی)</label>
            <input type="text" class="form-control datepicker" name="suggested_date">
        </div>
    </div>
    <button type="submit" class="btn btn-outline-success">ارسال درخواست</button>
</form>
