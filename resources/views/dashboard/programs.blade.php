<h5 class="mb-3">برنامه‌های ثبت‌نام‌شده من</h5>

@if(count($programs))
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>عنوان</th>
                    <th>تاریخ</th>
                    <th>مکان</th>
                    <th>وضعیت</th>
                    <th>لینک / فایل</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                    <tr>
                        <td>{{ $program->title }}</td>
                        <td>{{ jdate($program->date)->format('Y/m/d') }}</td>
                        <td>{{ $program->location ?? '-' }}</td>
                        <td>
                            @php
                                $status = $program->pivot->status;
                            @endphp
                            @if($status === 'approved')
                                <span class="badge bg-success">پذیرفته شده</span>
                            @elseif($status === 'pending')
                                <span class="badge bg-warning text-dark">در انتظار</span>
                            @else
                                <span class="badge bg-danger">رد شده</span>
                            @endif
                        </td>
                        <td>
                            @if($program->file_link)
                                <a href="{{ $program->file_link }}" target="_blank">دانلود فایل</a>
                            @elseif($program->group_link)
                                <a href="{{ $program->group_link }}" target="_blank">گروه برنامه</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            {{-- دکمه ارسال گزارش، فقط اگر تاریخ گذشته --}}
                            @if($program->date < now())
                                <a href="{{ route('dashboard.reports.create', $program->id) }}" class="btn btn-sm btn-outline-primary">نوشتن گزارش</a>
                            @endif

                            {{-- دکمه انصراف، فقط اگر هنوز نگذشته و وضعیت نهایی نیست --}}
                            @if($program->date >= now() && $status !== 'approved')
                                <form action="{{ route('dashboard.programs.withdraw', $program->id) }}" method="POST" class="d-inline-block ms-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('آیا مطمئن هستید؟')">انصراف</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>شما هنوز در هیچ برنامه‌ای ثبت‌نام نکرده‌اید.</p>
@endif
