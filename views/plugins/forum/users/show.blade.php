@extends('layouts.app')

@section('title', $user->name)

@section('content')
  <div class="bg-base-100 p-4 pt-10">
    <div class="card bg-base-200 p-4 flex flex-col">
      <img src="https://api.creepernation.net/avatar/{{ $user->name }}" class="md:hidden w-full rounded-xl" alt="{{ $user->name }}'s Avatar"/ />
      <div class="grid grid-cols-1 md:grid-cols-2 w-full">
        <div class="flex">
          <img src="https://api.creepernation.net/avatar/{{ $user->name }}" class="hidden md:flex rounded-lg w-32 h-32" alt="{{ $user->name }}'s Avatar"/>

          <div class="max-sm:p-4 pt-1 pb-0 ml-4">
            <h1 class="text-sm md:text-base pixel font-black">{{ $user->name }}</h1>
            <span class="badge" style="{{ $user->role->getBadgeStyle() }}; vertical-align: middle">
                @if($user->role->icon) <i class="{{ $user->role->icon }}"></i> @endif
                {{ $user->role->name }}
            </span>
            <div>
            <i class="fa-solid fa-font-awesome"></i>
            @if($user->user->website)
                    {{ trans('forum::messages.profile.website') }}:
                    <a href="{{ $user->user->website }}" target="_blank" rel="noopener noreferrer">
                         <i class="fa-solid fa-globe"></i> {{ $user->user->website }}
                    </a>
                @endif
            @if($user->user->discord)
                <p><i class="fa-brands fa-discord"></i> <b>{{ $user->user->discord }}</b></p>
            @endif
            @if($user->user->twitter)
                    Twitter:
                    <a href="https://bsky.app/{{ $user->user->twitter }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-bluesky"></i> {{ '@'.$user->user->twitter }}
                    </a>
            @endif
            @if($user->id === Auth::id())
                <a href="{{ route('forum.profile.edit') }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i> {{ trans('messages.actions.edit') }}
                </a>
            @endif
            </div>

          </div>
        </div>
        <div class="text-end">
          <p><strong>{{ trans('forum::messages.profile.discussions') }}:</strong> {{ $user->discussions_count }}</p>
          <p><strong>{{ trans('forum::messages.profile.posts') }}:</strong> {{ $user->posts_count }}</p>
          <p><strong>{{ trans('forum::messages.profile.likes') }}:</strong> {{ $user->likes_count }}</p>
          <p> <strong>{{ trans('forum::messages.profile.registered') }}:</strong>
                            {{ format_date($user->created_at) }}</p>
          @if($user->user->display_last_seen && $user->user->last_seen_at !== null)
                            <p>
                                <strong>{{ trans('forum::messages.profile.last_seen') }}:</strong>
                                {{ format_date($user->user->last_seen_at, true) }}
                            </p>
                        @endif
        </div>
      </div>@if($user->user->about)
      <div>
        
      <article class="m-4 prose lg:prose-lg max-w-full">{{ $user->user->parseAbout() }}</article>
      </div>@endif
    </div>
    <div class="grid grid-cols-1 mt-4 gap-4">
        @foreach($posts as $post)       
      <div class="card card-compact bg-base-300">
        <div class="card-body">
          <a href="{{ route('forum.discussions.show', $post->discussion) }}" class="card-title">{{ $post->discussion->title }}</a>
          <p>{{ Str::limit(strip_tags($post->parseContent())) }}</p>
          <div class="card-actions justify-end">
            <button class="btn btn-ghost"
              ><i class="fa-solid fa-calendar-days"></i> {{ format_date($post->created_at) }}</button
            >
          </div>
        </div>
      </div>
      @endforeach
    </div>
</div>
@endsection
