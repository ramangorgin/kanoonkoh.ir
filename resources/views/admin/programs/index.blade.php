@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>برنامه‌ها</h4>
        <a href="{{ route('admin.programs.create') }}" class="btn btn-success btn-sm">ایجاد برنامه جدید</a>
    </div>

    @if($programs->isEmpty())
        <div class="alert alert-warning">هیچ برنامه‌ای ثبت نشده است.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>تاریخ اجرا</th>
                    <th>منطقه</th>
                    <th>سرپرست</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                    <tr>
                        <td>{{ $program->id }}</td>
                        <td>{{ $program->title }}</td>
                        <td>{{ jdate($program->execution_date)->format('Y/m/d') }}</td>
                        <td>{{ $program->region }}</td>
                        <td>{{ optional($program->leader)->first_name }}</td>
                        <td>{{ $program->status }}</td>
                        <td>
                            <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-sm btn-primary">ویرایش</a>
                            <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('از حذف مطمئنی؟')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </form>
                        </td>
                        <td>
                        <a href="{{ route('admin.programs.registrations', $program->id) }}" class="btn btn-sm btn-outline-primary">
                            مشاهده ثبت‌نام‌ها
                        </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $programs->links() }}
        </div>
    @endif
@endsection
