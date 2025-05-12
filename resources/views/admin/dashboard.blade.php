@extends('admin.layout')

@section('content')
<h3>خوش آمدید {{ auth()->user()->first_name }}</h3>
<p class="text-muted">از سایدبار می‌تونید بخش‌های مختلف سیستم رو مدیریت کنید.</p>
@endsection
