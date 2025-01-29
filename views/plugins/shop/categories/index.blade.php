@extends('layouts.app')

@section('title', trans('shop::messages.title'))

@section('content')
    <div class="bg-base-100 p-4 pt-10">
        <div class="grid grid-cols-1 md:grid-cols-3 mx-2 lg:mx-6 gap-y-4 md:gap-4">
            <div>
                @include('shop::categories._sidebar')
                <br />
                @include('shop::categories._cards')
            </div>

            <div class="card bg-base-200 p-4 flex justify-center min-w-full md:col-span-2 row-span-4">
                <article class="prose lg:prose-lg min-w-full">
                    {{ $welcome }}
                </article>
            </div>
        </div>
    </div>
@endsection
