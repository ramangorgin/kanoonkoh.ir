@extends('admin.layout')

@section('content')
<h4 class="mb-4">تیکت‌ها</h4>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>موضوع</th>
            <th>کاربر</th>
            <th>بخش</th>
            <th>وضعیت</th>
            <th>تاریخ</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->subject }}</td>
            <td>{{ $ticket->user->first_name }}</td>
            <td>{{ $ticket->department }}</td>
            <td>{{ $ticket->status }}</td>
            <td>{{ jdate($ticket->created_at)->format('Y/m/d') }}</td>
            <td>
                <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-primary">نمایش</a>
                <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" class="d-inline" onsubmit="return confirm('مطمئن؟')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $tickets->links() }}
@endsection
