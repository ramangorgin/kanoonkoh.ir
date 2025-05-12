@extends('admin.layout')

@section('content')
<h4 class="mb-3">تغییر وضعیت گزارش: {{ $report->title }}</h4>

<form method="POST" action="{{ route('admin.reports.update', $report) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">وضعیت گزارش</label>
        <select name="status" class="form-select">
            @foreach(['pending' => 'در انتظار', 'approved' => 'تایید شده', 'rejected' => 'رد شده'] as $key => $label)
                <option value="{{ $key }}" {{ $report->status == $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
</form>
@endsection
