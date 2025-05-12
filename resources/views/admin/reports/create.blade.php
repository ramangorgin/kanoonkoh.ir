@extends('admin.layout')

@section('content')
<h4 class="mb-3">ایجاد گزارش جدید</h4>

<form method="POST" action="{{ route('admin.reports.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">عنوان گزارش</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">برنامه مربوطه</label>
        <select name="program_id" class="form-select" required>
            @foreach($programs as $program)
                <option value="{{ $program->id }}">{{ $program->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">نویسنده گزارش</label>
        <select name="user_id" class="form-select" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">محتوای گزارش</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">تصاویر (حداکثر ۱۰ عدد)</label>
        <input type="file" name="photos[]" class="form-control" multiple>
    </div>

    <button type="submit" class="btn btn-primary">ثبت گزارش</button>
</form>
@endsection
