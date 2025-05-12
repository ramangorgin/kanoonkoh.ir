@extends('admin.layout')

@section('content')
<h4 class="mb-4">تغییر وضعیت پرداخت</h4>

<form method="POST" action="{{ route('admin.payments.update', $payment) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">وضعیت</label>
        <select name="status" class="form-select">
            @foreach(['pending' => 'در انتظار', 'approved' => 'تایید شده', 'rejected' => 'رد شده'] as $key => $label)
                <option value="{{ $key }}" {{ $payment->status == $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
</form>
@endsection
