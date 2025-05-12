@extends('admin.layout')

@section('content')
<h4 class="mb-4">ویرایش دوره: {{ $course->title }}</h4>

<form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('admin.courses.partials.form', ['course' => $course])

    <button type="submit" class="btn btn-success mt-3">ذخیره تغییرات</button>
</form>
@endsection
