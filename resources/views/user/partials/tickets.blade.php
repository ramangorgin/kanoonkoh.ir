<div>
    <h5 class="mb-3">ارسال تیکت جدید</h5>

    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label>موضوع تیکت</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>متن پیام</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label>ضمیمه (اختیاری)</label>
            <input type="file" name="attachment" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">ارسال تیکت</button>
    </form>

    <h6 class="mb-3">تیکت‌های قبلی</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>موضوع</th>
                <th>تاریخ</th>
                <th>وضعیت</th>
                <th>فایل</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->tickets ?? [] as $ticket)
                <tr>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($ticket->created_at)->format('Y/m/d') }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>
                        @if($ticket->attachment)
                            <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">دانلود</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
