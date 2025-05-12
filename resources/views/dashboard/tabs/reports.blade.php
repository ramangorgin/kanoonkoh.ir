<h5 class="mb-3">گزارش‌های من</h5>

{{-- دکمه ثبت گزارش جدید --}}
<button class="btn btn-outline-primary mb-4" data-bs-toggle="collapse" data-bs-target="#report-form">ثبت گزارش جدید</button>

{{-- فرم ثبت گزارش --}}
<div class="collapse" id="report-form">
    @include('dashboard.partials.report-form')
</div>

{{-- جدول گزارش‌ها --}}
<table class="table table-bordered table-striped mt-4">
    <thead>
        <tr>
            <th>عنوان</th>
            <th>نوع</th>
            <th>برنامه</th>
            <th>تاریخ ثبت</th>
        </tr>
    </thead>
    <tbody>
        @forelse($reports as $report)
        <tr>
            <td>{{ $report->title }}</td>
            <td>{{ $report->type }}</td>
            <td>{{ $report->program->title }}</td>
            <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($report->created_at)->format('Y/m/d') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">هنوز گزارشی ثبت نکرده‌اید.</td>
        </tr>
        @endforelse
    </tbody>
</table>
