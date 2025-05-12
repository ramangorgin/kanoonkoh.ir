@extends('admin.layout')

@section('content')
<h4 class="mb-4">تیکت: {{ $ticket->subject }}</h4>

<div class="mb-3">
    <strong>بخش:</strong> {{ $ticket->department }}<br>
    <strong>کاربر:</strong> {{ $ticket->user->first_name }}<br>
    <strong>وضعیت:</strong> {{ $ticket->status }}<br>
</div>

<div class="card mb-4">
    <div class="card-body">
        {!! nl2br(e($ticket->message)) !!}
        @if($ticket->attachment)
            <hr>
            <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="btn btn-outline-secondary btn-sm">دانلود پیوست</a>
        @endif
    </div>
</div>

<h5>پاسخ‌ها:</h5>
@foreach($ticket->replies as $reply)
    <div class="card mb-2">
        <div class="card-body">
            <div class="mb-1"><strong>{{ $reply->user->is_admin ? 'ادمین' : 'کاربر' }}</strong></div>
            {!! nl2br(e($reply->message)) !!}
            @if($reply->attachment)
                <hr>
                <a href="{{ asset('storage/' . $reply->attachment) }}" target="_blank" class="btn btn-outline-secondary btn-sm">دانلود پیوست</a>
            @endif
        </div>
    </div>
@endforeach

<hr>

<h5>پاسخ جدید:</h5>
<form method="POST" action="{{ route('admin.tickets.reply', $ticket) }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <textarea name="message" class="form-control" rows="4" placeholder="متن پاسخ..." required></textarea>
    </div>
    <div class="mb-3">
        <input type="file" name="attachment" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">ارسال پاسخ</button>
</form>
@endsection
