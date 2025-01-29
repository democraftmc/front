@extends('layouts.app')

@section('title', trans('messages.posts.posts'))

@section('content')
    <div class="bg-base-100 p-8 pt-10 lg:px-32">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-6">
            @foreach ($posts as $post)
                <div class="card bg-base-200 w-full shadow-xl">
                    @if ($post->hasImage())
                        <figure>
                            <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" />
                        </figure>
                    @endif

                    <div class="card-body">
                        <a href="{{ route('posts.show', $post) }}" class="card-title text-2xl">
                            <span>{{ $post->title }}</span>
                            <span class="absolute right-4 top-4 btn btn-ghost"><i class="fa-solid fa-calendar-days"></i>
                                {{ format_date($post->published_at) }}</span>
                        </a>
                        <p>{{ Str::limit(strip_tags($post->content), 250) }}</p>
                        <div class="relative mb-10">
                            <div class="absolute flex left-0">
                                <img class="w-12 h-12 rounded-lg" src="https://api.creepernation.net/avatar/{{ $post->author->name }}" />
                                <button class="flex flex-col justify-center items-center px-1 ml-1">{{ $post->author->name }}
                                    <span class="badge" style="{{ $post->author->role->getBadgeStyle() }};">
                                        @if($post->author->role->icon) <i class="{{ $post->author->role->icon }}"></i> @endif
                                        {{ $post->author->role->name }}
                                    </span></button>
                            </div>
                            <a href="{{ route('posts.show', $post) }}"
                                class="absolute right-0 btn btn-primary">{{ trans('messages.posts.read') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
