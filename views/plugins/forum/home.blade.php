@extends('layouts.app')

@section('title', trans('forum::messages.title'))

@section('content')
    <div class="bg-base-100 p-4 pt-10">
        <div class="flex max-sm:flex-col gap-4 w-full">
            <div class="md:w-3/4">
                @foreach ($categories as $category)
                    <div class="grid grid-cols-1 gap-y-4 md:m-4 my-8">
                        <h2 class="text-4xl font-bold relative align-middle">
                            {{ $category->name }}
                            <span class="hidden md:absolute right-0 text-xl font-normal">{{ $category->description }}</span>
                        </h2>
                        <p class="md:hidden right-0 text-xl font-normal">{{ $category->description }}</p>
                        @foreach ($category->forums as $forum)
                            @can('view', $forum)
                                <div class="bg-base-300 p-2 px-4 rounded-xl flex items-center">
                                    <a href="{{ route('forum.show', $forum->slug) }}">
                                        <i class="{{ $forum->icon ?? 'bi bi-chat' }} text-primary text-4xl mr-4"></i>
                                    </a>
                                    <div>
                                        <a href="{{ route('forum.show', $forum->slug) }}" class="text-2xl font-bold">
                                            {{ $forum->name }}
                                        </a>
                                        <p>{{ $forum->description ?? '' }}</p>
                                    </div>
                                </div>
                            @endcan
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="md:w-1/4">

                @auth<div class="card bg-base-200">
                        <div class="card-body flex flex-row items-center">
                            <img class="rounded-lg h-16 w-16" src="https://api.creepernation.net/avatar/{{ $user->name }}"
                                alt="{{ $user->name }}'s Avatar" />
                            <div>
                                <a class="card-title" href="{{ route('forum.users.show', $user) }}">{{ $user->name }}</a>
                                <span class="badge" style="{{ $user->role->getBadgeStyle() }}">
                                    @if ($user->role->icon)
                                        <i class="{{ $user->role->icon }}"></i>
                                    @endif
                                    {{ $user->role->name }}
                                </span>
                            </div>
                            <a href="{{ route('forum.users.show', $user) }}" class="absolute right-5 btn btn-ghost"><i class="fa-solid fa-pen-to-square fa-2xl"></i></a>
                        </div>
                    </div>
                @endauth

                @if (!$latestPosts->isEmpty())
                    <div class="card card-compact bg-base-200 mt-4">
                        <div class="card-body">
                            <h2 class="card-title">
                                <i class="fa-solid fa-comments"></i> {{ trans('forum::messages.latest.title') }}
                            </h2>
                            @foreach($latestPosts as $post)
                            <div class="bg-base-300 p-2 rounded-xl">
                                <h3 class="font-bold">{{ $post->discussion->title }}</h3>
                                <div class="flex">
                                    <img class="rounded h-4 w-4 translate-y-0.5 mr-1" src="https://api.creepernation.net/avatar/{{ $post->author->name }}" alt="{{ $post->author->name }}'s Avatar" />
                                    <span>{{ $post->author->name }}, {{ format_date($post->created_at) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="card card-compact bg-base-200 mt-4">
                    <div class="card-body">
                        <h2 class="card-title">
                            <i class="fa-solid fa-chart-pie"></i> {{ trans('forum::messages.stats.title') }}
                        </h2>
                        <p><i class="fa-solid fa-note-sticky"></i> {{ trans_choice('forum::messages.stats.discussions', $discussionsCount) }}</p>
                        <p><i class="fa-solid fa-comment"></i> {{ trans_choice('forum::messages.stats.posts', $postsCount) }}</p>
                        <p><i class="fa-solid fa-users"></i> {{ trans_choice('forum::messages.stats.users', $usersCount) }}</p>
                    </div>
                </div>
                <div class="card card-compact bg-base-200 mt-4">
                    <div class="card-body">
                        <h2 class="card-title">
                            <i class="fa-solid fa-users"></i> {{ trans('forum::messages.online.title') }}
                        </h2>
                        <div class="flex flex-wrap gap-x-2">
                            @forelse($onlineUsers as $id => $user)
                            <a href="{{ route('forum.users.show', $user) }}" class="flex">
                                <img class="rounded h-4 w-4 translate-y-0.5 mr-1" src="https://api.creepernation.net/avatar/{{ $user->name }}" alt="{{ $user->name }}'s Avatar" />
                                <span>{{ $user->name }}</span>
                            </a>
                            @empty
                                {{ trans('forum::messages.online.none') }}
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
