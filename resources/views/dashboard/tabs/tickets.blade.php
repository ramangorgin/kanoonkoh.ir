<h5 class="mb-3">ارسال تیکت جدید</h5>

<form method="POST" action="{{ route('user.tickets.store') }}" enctype="multipart/form-data" class="border rounded p-3 mb-4 bg-light">
    @csrf

    <div class="row mb-3">
        <div class="col-md-6">
            <label>موضوع تیکت</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label>بخش مربوطه</label>
            <select name="department" class="form-select" required>
                <option value="">انتخاب کنید</option>
                @foreach([
                    'کارگروه فرهنگی',
                    'کارگروه محیط‌زیست',
                    'کارگروه طبیعت‌گردی',
                    'کارگروه روابط عمومی',
                    'کارگروه اداری',
                    'کارگروه فنی و آموزشی'
                ] as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label>متن پیام</label>
        <textarea name="message" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label>ضمیمه (اختیاری)</label>
        <input type="file" name="attachment" class="form-control">
    </div>

    <button type="submit" class="btn btn-outline-primary">ارسال تیکت</button>
</form>

<hr class="my-4">

<h5 class="mb-3">لیست تیکت‌های من</h5>

@forelse($tickets as $ticket)
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>{{ $ticket->subject }}</strong>
            <small class="text-muted">{{ $ticket->department }}</small>
        </div>
        <div class="card-body">

            {{-- پیام اولیه کاربر --}}
            <div class="mb-3 text-end">
                <div class="bg-light border rounded p-3">
                    <div class="fw-bold mb-1">شما:</div>
                    <p class="mb-1">{{ $ticket->message }}</p>
                    @if($ticket->attachment)
                        <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">دانلود فایل ضمیمه</a>
                    @endif
                </div>
            </div>

            {{-- پاسخ‌ها --}}
            @foreach($ticket->replies as $reply)
                <div class="mb-3 {{ $reply->user_id ? 'text-end' : 'text-start' }}">
                    <div class="p-3 rounded border bg-{{ $reply->user_id ? 'primary text-white' : 'secondary text-white' }}">
                        <div class="small mb-1">{{ $reply->user_id ? 'شما' : 'ادمین' }}</div>
                        <div>{{ $reply->message }}</div>
                        @if($reply->attachment)
                            <div><a href="{{ asset('storage/' . $reply->attachment) }}" target="_blank" class="text-white">دانلود فایل</a></div>
                        @endif
                    </div>
                </div>
            @endforeach

            {{-- فرم پاسخ جدید توسط کاربر --}}
            <form method="POST" action="{{ route('user.tickets.reply', $ticket->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <textarea name="message" class="form-control" placeholder="پاسخ خود را بنویسید..." rows="3" required></textarea>
                </div>
                <div class="mb-2">
                    <input type="file" name="attachment" class="form-control">
                </div>
                <button type="submit" class="btn btn-sm btn-outline-success">ارسال پاسخ</button>
            </form>

        </div>
        <div class="card-footer text-end">
            <small class="text-muted">
                وضعیت:
                @if($ticket->status === 'open')
                    <span class="badge bg-warning text-dark">باز</span>
                @elseif($ticket->status === 'answered')
                    <span class="badge bg-info">پاسخ داده شده</span>
                @else
                    <span class="badge bg-secondary">بسته‌شده</span>
                @endif
            </small>
        </div>
    </div>
@empty
    <div class="alert alert-info">شما هنوز هیچ تیکتی ثبت نکرده‌اید.</div>
@endforelse
