@extends('layouts.app', ['noBar' => true])

@section('content')
    <div class="flex justify-center pb-10">
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body justify-center">
                <h2 class="card-title justify-center text-2xl font-bold">
                    @yield('code') @yield('title')
                </h2>
                <p>@yield('message')</p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="bi bi-house"></i> {{ trans('errors.home') }}
                </a>
            </div>
        </div>
    </div>
@endsection
