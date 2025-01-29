@extends('layouts.news')

@section('title', $post->title)
@section('description', $post->description)
@section('type', 'article')

@push('meta')
    <meta property="og:article:author:username" content="{{ $post->author->name }}">
    <meta property="og:article:published_time" content="{{ $post->published_at->toIso8601String() }}">
    <meta property="og:article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
@endpush

@section('content')
    @if (!$post->isPublished())
        <div class="alert alert-info" role="alert">
            <i class="bi bi-info-circle"></i> {{ trans('messages.posts.unpublished') }}
        </div>
    @endif
    <div class="bg-base-100 p-8 pt-10 lg:px-32">

        <h1 class="text-center text-2xl md:text-4xl font-bold">{{ $post->title }}</h1>

        @if ($post->hasImage())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 my-6 items-center">
                <img class="rounded-xl" src="{{ $post->imageUrl() }}" alt="{{ $post->title }}">
            @else
                <div class="grid grid-cols-1 items-center gap-12 my-6">
        @endif
        <article class="m-4 prose lg:prose-lg max-w-full">
            {!! $post->content !!}
        </article>
    </div>
    <div class="flex flex-col md:flex-row justify-center items-center gap-4">
        <button type="button" class="btn btn-primary @if ($post->isLiked()) active @endif"
            @guest disabled @endguest data-like-url="{{ route('posts.like', $post) }}">
            <i class="bi bi-heart @if ($post->isLiked()) d-none @endif" data-liked="true"></i>
            <i class="bi bi-heart-fill @if (!$post->isLiked()) d-none @endif" data-liked="false"></i>
            @lang('messages.likes', ['count' => '<span class="likes-count">' . $post->likes->count() . '</span>'])
            <span class="load-spinner d-none loading loading-infinity loading-lg" role="status"></span>
        </button>
        <div class="flex bg-base-300 rounded-lg">
            <img class="w-12 h-12 rounded-lg" src="https://api.creepernation.net/avatar/{{ $post->author->name }}" />
            <button class="flex flex-col justify-center items-center px-1 ml-1">{{ $post->author->name }}
                <span class="badge" style="{{ $post->author->role->getBadgeStyle() }};">
                    @if ($post->author->role->icon) <i
                            class="{{ $post->author->role->icon }}"></i> @endif
                    {{ $post->author->role->name }}
                </span></button>
        </div>

        <span class="btn btn-ghost"><i class="fa-solid fa-calendar-days"></i>
            {{ format_date($post->published_at) }}</span>
    </div>



    <section class="my-8" id="comments">
        @foreach ($post->comments as $comment)
            <div class="flex flex-row w-full my-2">
                <img class="rounded" src="{{ $comment->author->getAvatar() }}" alt="{{ $comment->author->name }}"
                    width="64">
                <div class="pl-2" style="width: inherit;">
                    {{ $comment->parseContent() }}
                    <p class="card-text text-body-secondary">
                        @lang('messages.comments.author', ['user' => e($comment->author->name), 'date' => format_date($comment->created_at, true)])
                    </p>
                </div>
                @can('delete', $comment)
                    <a class="btn btn-error" href="{{ route('posts.comments.destroy', [$post, $comment]) }}"
                        data-confirm="delete" title="{{ trans('messages.actions.delete') }}">
                        <i class="fa-solid fa-trash"></i>
                    </a>
            @endif
            </div>
            @endforeach
        </section>

        @can('create', \Azuriom\Models\Comment::class)
            <div class="card bg-base-300 mt-4">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ trans('messages.comments.create') }}
                    </h3>

                    <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                        @csrf

                        <textarea placeholder="{{ trans('messages.comments.content') }}"
                            class="w-full textarea textarea-bordered textarea-lg @error('content') textarea-error @enderror" id="content"
                            name="content" required></textarea>

                        @error('content')
                            <span class="alert alert-error" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror


                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-comments"></i> {{ trans('messages.actions.comment') }}
                        </button>
                    </form>
                </div>
            </div>
        @endcan

        @guest
            <div class="alert alert-info" role="alert">
                {{ trans('messages.comments.guest') }}
            </div>
        @endguest

        </div>
        </div>

        <!-- Delete confirm modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="confirmDeleteLabel">{{ trans('messages.comments.delete') }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">{{ trans('messages.comments.delete_confirm') }}</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"
                            data-bs-dismiss="modal">{{ trans('messages.actions.cancel') }}</button>

                        <form id="confirmDeleteForm" method="POST">
                            @method('DELETE')
                            @csrf

                            <button class="btn btn-danger" type="submit">{{ trans('messages.actions.delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
