
@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">مدیریت برنامه‌ها</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>فهرست برنامه‌ها</h4>
        <a href="{{ route('admin.programs.create') }}" class="btn btn-success">ایجاد برنامه جدید</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>تاریخ شروع</th>
                    <th>تاریخ پایان</th>
                    <th>وضعیت ثبت‌نام</th>
                    <th>مسئولین</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programs as $index => $program)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->start_date }}</td>
                        <td>{{ $program->end_date }}</td>
                        <td>
                            @if($program->is_registration_open)
                                <span class="badge badge-success">باز</span>
                            @else
                                <span class="badge badge-secondary">بسته</span>
                            @endif
                        </td>
                        <td>
                            @if($program->roles && $program->roles->count())
                                <ul class="list-unstyled mb-0 text-right small">
                                    @foreach ($program->roles as $role)
                                        <li>
                                            {{ $role->role_title }}:
                                            @if($role->user)
                                                {{ $role->user->name }}
                                            @elseif($role->custom_name)
                                                {{ $role->custom_name }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted small">ندارد</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.programs.show', $program->id) }}" class="btn btn-sm btn-info">نمایش</a>
                            <a href="{{ route('admin.programs.edit', $program->id) }}" class="btn btn-sm btn-warning">ویرایش</a>
                            <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST" class="d-inline" onsubmit="return confirm('آیا از حذف مطمئن هستید؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">هیچ برنامه‌ای ثبت نشده است.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
