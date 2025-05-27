@extends('layouts.app')

@section('title', 'برنامه‌های من')

@section('content')
<div class="container my-5">
    <h3 class="mb-4">برنامه‌های ثبت‌نام‌شده توسط شما</h3>

    @if($programs->isEmpty())
        <div class="alert alert-info">شما هنوز در هیچ برنامه‌ای ثبت‌نام نکرده‌اید.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>عنوان برنامه</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                    <tr>
                        <td>{{ $program->title }}</td>
                        <td>{{ jdate($program->start_date)->format('Y/m/d') }}</td>
                        <td>{{ $program->pivot->status ?? 'ثبت‌نام شده' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
