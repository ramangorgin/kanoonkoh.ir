@extends('admin.layout')

@section('content')
<h4 class="mb-4">ایجاد دوره جدید</h4>

<form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
    @csrf

    @include('admin.courses.partials.form')

    <button type="submit" class="btn btn-primary mt-3">ثبت دوره</button>
</form>
@endsection
