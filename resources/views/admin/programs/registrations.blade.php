@extends('layouts.app')

@section('title', 'ثبت‌نام‌های برنامه ' . $program->title)

@section('content')
<div class="container">
    <h4 class="mb-4">ثبت‌نام‌های برنامه {{ $program->title }}</h4>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>نام</th>
                <th>شماره تماس</th>
                <th>کدملی</th>
                <th>محل سوار شدن</th>
                <th>کد تراکنش</th>
                <th>وضعیت</th>
                <th>تاریخ</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $reg)
                <tr>
                    <td>{{ $reg->user ? $reg->user->full_name : $reg->guest_name }}</td>
                    <td>{{ $reg->user?->mobile ?? $reg->guest_phone }}</td>
                    <td>{{ $reg->user?->national_id ?? $reg->guest_national_id }}</td>
                    <td>{{ $reg->pickup_location ?? '-' }}</td>
                    <td>{{ $reg->transaction_code ?? '-' }}</td>
                    <td>
                        @if($reg->status == 'pending')
                            <span class="badge bg-warning">در انتظار</span>
                        @elseif($reg->status == 'approved')
                            <span class="badge bg-success">تأیید شده</span>
                        @else
                            <span class="badge bg-danger">رد شده</span>
                        @endif
                    </td>
                    <td>{{ jdate($reg->created_at)->format('Y/m/d H:i') }}</td>
                    <td>
                        @if($reg->status == 'pending')
                            <form action="{{ route('admin.programs.registrations.approve', $reg->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success">تأیید</button>
                            </form>
                            <form action="{{ route('admin.programs.registrations.reject', $reg->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-danger">رد</button>
                            </form>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">ثبت‌نامی وجود ندارد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
