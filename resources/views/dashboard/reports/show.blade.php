<h5 class="mb-3">گزارش‌های من</h5>

@if(count($reports))
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>برنامه</th>
                    <th>تاریخ ارسال</th>
                    <th>وضعیت</th>
                    <th>فایل پیوست</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->program->title }}</td>
                        <td>{{ jdate($report->created_at)->format('Y/m/d H:i') }}</td>
                        <td>
                            @if($report->status === 'pending')
                                <span class="badge bg-warning text-dark">در انتظار بررسی</span>
                            @elseif($report->status === 'approved')
                                <span class="badge bg-success">تایید شده</span>
                            @elseif($report->status === 'rejected')
                                <span class="badge bg-danger">رد شده</span>
                            @endif
                        </td>
                        <td>
                            @if($report->attachment)
                                <a href="{{ asset('storage/' . $report->attachment) }}" target="_blank">دانلود</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dashboard.reports.show', $report->id) }}" class="btn btn-sm btn-outline-dark">مشاهده</a>
                            @if($report->status === 'rejected')
                                <a href="{{ route('dashboard.reports.edit', $report->id) }}" class="btn btn-sm btn-outline-warning">ویرایش</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>شما تاکنون گزارشی ارسال نکرده‌اید.</p>
@endif
