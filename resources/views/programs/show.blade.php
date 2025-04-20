@extends('layout')

@section('title', $program->title)

@php
    use Morilog\Jalali\Jalalian;
@endphp


@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $program->title }}</h2>

    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $program->cover_image) }}" class="img-fluid rounded" alt="{{ $program->title }}">
        </div>
        <div class="col-md-6">
            <p><strong>نوع برنامه:</strong> {{ $program->type }}</p>
            <p><strong>منطقه:</strong> {{ $program->region }}</p>
            <p><strong>تاریخ اجرا:</strong> {{ Jalalian::fromDateTime($program->execution_date)->format('Y/m/d') }}</p>
            <p><strong>هزینه برای اعضا:</strong> {{ number_format($program->member_cost) }} تومان</p>
            <p><strong>هزینه برای مهمان:</strong> {{ number_format($program->guest_cost) }} تومان</p>
            <p><strong>ارتفاع قله (در صورت وجود):</strong> {{ $program->peak_altitude ?? '---' }} متر</p>
        </div>
    </div>

    <hr class="my-4">

    <h4>توضیحات کامل برنامه:</h4>
    <p>{!! nl2br(e($program->description)) !!}</p>

    <h5 class="mt-4">تجهیزات مورد نیاز:</h5>
    <p>{{ $program->required_equipment }}</p>

    <h5>وعده‌های غذایی مورد نیاز:</h5>
    <p>{{ $program->required_meals }}</p>

    <a href="{{ route('programs.archive') }}" class="btn btn-secondary mt-3">بازگشت به آرشیو برنامه‌ها</a>
</div>
@endsection
