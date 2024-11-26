@php
    $alertTypes = ['success', 'error', 'warning', 'info']; // أنواع التنبيهات المحتملة
@endphp

@foreach ($alertTypes as $type)

@if(session()->has($type))
    <div class="alert alert-{{ $type }}">
        {{session($type)}}
    </div>
@endif

@endforeach
