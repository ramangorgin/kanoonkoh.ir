@extends('admin.layout')

@section('content')
    <h4 class="mb-4">جزئیات برنامه: {{ $program->title }}</h4>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>عنوان</th>
                <td>{{ $program->title }}</td>
            </tr>
            <tr>
                <th>تاریخ اجرا</th>
                <td>{{ jdate($program->execution_date)->format('Y/m/d') }}</td>
            </tr>
            <tr>
                <th>منطقه</th>
                <td>{{ $program->region }}</td>
            </tr>
            <tr>
                <th>نوع</th>
                <td>{{ $program->type }}</td>
            </tr>
            <tr>
                <th>سطح سختی</th>
                <td>{{ $program->difficulty_level }}</td>
            </tr>
            <tr>
                <th>سرپرست</th>
                <td>{{ optional($program->leader)->first_name }}</td>
            </tr>
            <tr>
                <th>هزینه اعضا</th>
                <td>{{ number_format($program->member_cost) }} تومان</td>
            </tr>
            <tr>
                <th>هزینه مهمان</th>
                <td>{{ number_format($program->guest_cost) }} تومان</td>
            </tr>
            <tr>
                <th>توضیحات</th>
                <td>{{ $program->description }}</td>
            </tr>
            <tr>
                <th>تصویر</th>
                <td>
                    @if($program->cover_image)
                        <img src="{{ asset('storage/' . $program->cover_image) }}" width="200">
                    @else
                        <span class="text-muted">تصویری ثبت نشده</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">بازگشت</a>
@endsection
