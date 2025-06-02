@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-4">نمایش تیکت: {{ $ticket->subject }}</h4>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>توضیحات اولیه:</strong> {{ $ticket->message }}</p>
            <p><strong>تاریخ ارسال:</strong> {{ jdate($ticket->created_at)->format('Y/m/d H:i') }}</p>
        </div>
    </div>

    <div class="chat-box mb-4">
        @foreach($ticket->replies as $reply)
            <div class="chat-message {{ $reply->user_id === $ticket->user_id ? 'right' : 'left' }}">
                <div class="message-content">
                    {{ $reply->message }}
                    <div class="message-time">{{ jdate($reply->created_at)->format('Y/m/d H:i') }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <form method="POST" action="{{ route('admin.tickets.reply', $ticket->id) }}">
        @csrf
        <div class="form-group">
            <label for="message">پاسخ جدید:</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">ارسال پاسخ</button>
    </form>
</div>
@endsection

@push('styles')
<style>
.chat-box {
    border: 1px solid #ddd;
    padding: 15px;
    background: #f9f9f9;
    max-height: 500px;
    overflow-y: auto;
}

.chat-message {
    max-width: 70%;
    margin-bottom: 15px;
    clear: both;
}

.chat-message.right {
    float: right;
    text-align: right;
    background: #e0f7fa;
    padding: 10px;
    border-radius: 10px 10px 0 10px;
}

.chat-message.left {
    float: left;
    text-align: left;
    background: #fff3e0;
    padding: 10px;
    border-radius: 10px 10px 10px 0;
}

.message-content {
    word-wrap: break-word;
}

.message-time {
    font-size: 0.8rem;
    color: #888;
    margin-top: 5px;
}
</style>
@endpush
