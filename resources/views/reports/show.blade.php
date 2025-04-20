@extends('layout')

@section('title', $report->title)

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $report->title }}</h2>

    <img src="{{ asset('storage/' . $report->cover_image) }}" class="img-fluid mb-4 rounded">

    <p><strong>تاریخ:</strong> {{ jdate($report->date)->format('Y/m/d') }}</p>
    <p><strong>نوع:</strong> {{ $report->type }}</p>
    <p><strong>منطقه:</strong> {{ $report->area }}</p>
    <p><strong>تعداد نفرات:</strong> {{ $report->participant_count }}</p>

    <p><strong>متن گزارش:</strong></p>
    <p>{{ $report->full_report }}</p>

    @if($report->pdf_path)
        <p><a href="{{ asset('storage/' . $report->pdf_path) }}" class="btn btn-outline-dark" target="_blank">دانلود PDF</a></p>
    @endif

    @if($report->track_url)
        <p><a href="{{ $report->track_url }}" class="btn btn-outline-info" target="_blank">مشاهده ترک مسیر</a></p>
    @endif
</div>
@endsection
