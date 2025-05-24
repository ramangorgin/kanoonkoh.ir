<h5 class="mb-3">دوره‌های من</h5>

@if(count($courses))
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>عنوان دوره</th>
                    <th>تاریخ برگزاری</th>
                    <th>وضعیت</th>
                    <th>گواهی</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>
                            <a href="{{ route('courses.show', $course->id) }}" target="_blank">
                                {{ $course->title }}
                            </a>
                        </td>
                        <td>{{ jdate($course->date)->format('Y/m/d') }}</td>
                        <td>
                            @php
                                $status = $course->pivot->status;
                            @endphp
                            @if($status === 'approved')
                                <span class="badge bg-success">پذیرفته‌شده</span>
                            @elseif($status === 'pending')
                                <span class="badge bg-warning text-dark">در انتظار</span>
                            @else
                                <span class="badge bg-danger">رد شده</span>
                            @endif
                        </td>
                        <td>
                            @if($course->pivot->certificate_file)
                                <a href="{{ asset('storage/' . $course->pivot->certificate_file) }}" target="_blank">دانلود گواهی</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($course->date > now() && $status !== 'approved')
                                <form action="{{ route('dashboard.courses.withdraw', $course->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('آیا از انصراف اطمینان دارید؟')">انصراف</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>شما هنوز در هیچ دوره‌ای ثبت‌نام نکرده‌اید.</p>
@endif
