@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-4">لیست تیکت‌ها</h4>

    <form method="GET" action="{{ route('admin.tickets.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="جستجو بر اساس عنوان یا نام کاربر" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">جستجو</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="thead-light">
                <tr>
                    <th>ردیف</th>
                    <th>کاربر</th>
                    <th>عنوان</th>
                    <th>وضعیت</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $index => $ticket)
                    <tr>
                        <td>{{ $index + 1 + ($tickets->currentPage() - 1) * $tickets->perPage() }}</td>
                        <td>{{ $ticket->user->name ?? '---' }}</td>
                        <td><a href="{{ route('admin.tickets.show', $ticket->id) }}">{{ $ticket->subject }}</a></td>
                        <td>
                            @if($ticket->closed)
                                <span class="badge badge-danger">بسته</span>
                            @else
                                <span class="badge badge-success">باز</span>
                            @endif
                        </td>
                        <td>{{ jdate($ticket->created_at)->format('Y/m/d H:i') }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.tickets.toggle', $ticket->id) }}" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $ticket->closed ? 'btn-success' : 'btn-danger' }}">
                                    {{ $ticket->closed ? 'باز کردن' : 'بستن' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">تیکتی یافت نشد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $tickets->withQueryString()->links() }}
    </div>
</div>
@endsection
