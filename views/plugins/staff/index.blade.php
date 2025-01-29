@extends('layouts.app')

@section('title', 'Staff')
@if(isset($settings['style']) && $settings['style'] === "1")
    @push('scripts')
        <script defer data-cfasync="false" src="{{ plugin_asset('staff', 'js/glide.min.js') }} "></script>
        <script defer data-cfasync="false" src="{{ plugin_asset('staff', 'js/script.js') }} "></script>
    @endpush
@endif
@push('styles')
    @if(isset($settings['style']) && $settings['style'] === "1")
        <link href="{{ plugin_asset('staff', 'css/glide.core.min.css') }} " rel="stylesheet">
        <link href="{{ plugin_asset('staff', 'css/glide.theme.min.css') }} " rel="stylesheet">
    @endif
    <link href="{{ plugin_asset('staff', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
  <div class="bg-base-100 p-4 pt-10">
        @if($staffs->count() >= 1)
            @php
                $alignment = match ($settings['alignment'] ?? 'start') {
                    'center' => 'center',
                    'end' => 'end',
                    default => 'start',
                };
                $column = isset($settings['column']) ? intdiv(12,(int) $settings['column']) : intdiv(12,1)
            @endphp

            @switch($settings['style'] ?? '1')
                @case('1')
                    @include('staff::styles._slider' , ['title' => 'h2'])
                    @break
                @case('2')
                    @include('staff::styles._list' , ['title' => 'h2'])
                    @break
                @case('3')
                    @include('staff::styles._rounded' , ['title' => 'h2'])
                    @break
                @case('4')
                    @include('staff::styles._tags-list' , ['title' => 'h3'])
                    @break
                @case('5')
                    @include('staff::styles._tags-rounded' , ['title' => 'h3'])
                    @break
                @case('6')
                    @include('staff::styles._tags-slider' , ['title' => 'h3'])
                    @break
            @endswitch

        @else
            <div class="alert alert-warning" role="alert">
                {{ trans('staff::messages.staff-empty') }}
            </div>
        @endif
    </div>
@endsection
