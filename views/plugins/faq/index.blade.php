@extends('layouts.app')

@section('title', trans('faq::messages.title'))

@section('content')
    <div class="bg-base-100 p-4 pt-10">
        @if ($questions->isEmpty())
            <div class="alert alert-info" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="h-6 w-6 shrink-0 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ trans('faq::messages.empty') }}</span>
            </div>
        @else
            @foreach ($questions as $id => $question)
                <div class="collapse collapse-arrow bg-base-200">
                    <input type="radio" name="faq" checked="checked" />
                    <div class="collapse-title text-xl font-medium">{{ $question->name }}</div>
                    <div class="collapse-content">
                        <p>{!! $question->answer !!}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
