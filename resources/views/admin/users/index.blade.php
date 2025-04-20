@extends('layout')

@section('title', 'کاربران')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">کاربران سایت</h2>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>نام</th>
                <th>برنامه‌ها</th>
                <th>دوره‌ها</th>
                <th>گزارش‌ها</th>
                <th>مشاهده</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->programRegistrations->count() }}</td>
                    <td>{{ $user->courseRegistrations->count() }}</td>
                    <td>{{ $user->reports->count() }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">نمایش</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
