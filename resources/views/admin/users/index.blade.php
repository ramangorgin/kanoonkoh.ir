@extends('admin.layout')

@section('content')
<h4 class="mb-4">مدیریت کاربران</h4>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="alert alert-info">کل کاربران: <strong>{{ $stats['total'] }}</strong></div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-success">اعضای رسمی: <strong>{{ $stats['official'] }}</strong></div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-warning">اعضای افتخاری: <strong>{{ $stats['honorary'] }}</strong></div>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>نام</th>
            <th>ایمیل</th>
            <th>نوع عضویت</th>
            <th>برنامه‌ها</th>
            <th>دوره‌ها</th>
            <th>گزارش‌ها</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->membership_type }}</td>
            <td>{{ $user->programs_count }}</td>
            <td>{{ $user->courses_count }}</td>
            <td>{{ $user->reports_count }}</td>
            <td>
                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-secondary">مشاهده</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}
@endsection
