@extends('layouts.app')

@section('title', 'پشتیبانی')

@section('content')
<div class="px-5 py-5">
<h5 class="mb-3">تیکت‌های من</h5>

<a href="{{ route('dashboard.tickets.create') }}" class="btn btn-sm btn-outline-primary mb-3">+ ارسال تیکت جدید</a>

@if(!empty($tickets) && count($tickets))

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>موضوع</th>
                    <th>دسته‌بندی</th>
                    <th>تاریخ ارسال</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->category ?? '-' }}</td>
                        <td>{{ jdate($ticket->created_at)->format('Y/m/d H:i') }}</td>
                        <td>
                            @if($ticket->status === 'open')
                                <span class="badge bg-warning text-dark">باز</span>
                            @elseif($ticket->status === 'answered')
                                <span class="badge bg-info text-dark">پاسخ داده‌شده</span>
                            @elseif($ticket->status === 'closed')
                                <span class="badge bg-secondary">بسته‌شده</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dashboard.tickets.show', $ticket->id) }}" class="btn btn-sm btn-outline-dark">مشاهده</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@else
    <p>تاکنون هیچ تیکتی ارسال نکرده‌اید.</p>
@endif
</div>
@endsection