@extends('forum::layouts.forum', ['includeEdit' => true])

@section('title', $discussion->title)

@push('meta')
    <meta property="og:article:author:username" content="{{ $discussion->author->name }}">
    <meta property="og:article:published_time" content="{{ $discussion->created_at->toIso8601String() }}">
    <meta property="og:article:modified_time" content="{{ $discussion->updated_at->toIso8601String() }}">
@endpush

@section('forum')
    <div class="flex justify-center">
        <a>{{ $discussion->title }}</a>
    </div>
    <div class="grid grid-cols-1 p-2 md:px-6 gap-4">
        @foreach ($discussion->posts as $post)
            <div class="flex flex-col md:flex-row w-full bg-base-300 rounded-lg">
                <div class="m-3 p-1 flex flex-col min-w-fit relative">
                    <div class="flex max-sm:justify-center w-full md:w-64">
                        <a href="{{ route('forum.users.show', $post->author) }}">
                        <img class="h-20 w-20 rounded-lg"
                            src="https://api.creepernation.net/avatar/{{ $post->author->name }}"
                            alt="{{ $post->author->name }}'s Avatar" /></a>
                        <div class="ml-2 flex flex-col">
                            <a href="{{ route('forum.users.show', $post->author) }}" class="text-lg font-bold link-hover">{{ $post->author->name }}</a>
                            <span class="badge" style="{{ $post->author->role->getBadgeStyle() }};">
                                @if ($post->author->role->icon)
                                    <i class="{{ $post->author->role->icon }}"></i>
                                @endif
                                {{ $post->author->role->name }}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-center gap-x-6 mt-1">
                        <span><i class="fa-solid fa-comment"></i> {{ $post->author->posts_count }}</span>
                        <span><i class="fa-solid fa-pen-clip"></i> {{ $post->author->discussions_count }}</span>
                        <span><i class="fa-solid fa-heart"></i> {{ $post->author->likes_count }}</span>
                    </div>

                    <div class="hidden md:absolute left-1 bottom-1">
                        <a class="btn btn-ghost">
                            <i class="fa-solid fa-calendar-days"></i> {{ format_date($post->created_at, true) }}
                        </a>
                    </div>
                </div>
                <div class="relative pb-16 w-full">
                    <article class="m-4 prose lg:prose-lg max-w-full">
                        {{ $post->parseContent() }}
                    </article>
                    @if ($post->author->signature !== null)
                        <div class="divider"></div>
                        <article class="m-4 prose lg:prose-lg max-w-full">
                            {!! $post->author->parseSignature() !!}
                        </article>
                    @endif


                    <div class="flex ms:hidden gap-2 absolute left-4">
                        <a class="btn btn-ghost">
                            <i class="fa-solid fa-calendar-days"></i> {{ format_date($post->created_at, true) }}
                        </a>
                    </div>

                    <div class="flex gap-2 absolute right-4">
                        <button type="button"
                            class="btn btn-primary btn-sm @if ($post->isLiked()) active @endif"
                            @guest disabled @endguest data-like-url="{{ route('forum.posts.like', $post) }}">
                            <i class="fa-solid fa-heart"></i>
                            <span class="likes-count">{{ $post->likes->count() }}</span>
                            <span
                                class="d-none load-spinner loading loading-infinity loading-lg"
                                role="status"></span>
                        </button>
                        @if (!$loop->first && (!$discussion->is_locked || auth()->user()?->isAdmin()))
                            @can('edit', $post)
                                <a href="{{ route('forum.discussions.posts.edit', [$discussion, $post]) }}"
                                    class="btn btn-info" title="{{ trans('messages.actions.edit') }}" data-bs-toggle="tooltip">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            @endcan
                            @can('delete', $post)
                                <form action="{{ route('forum.discussions.posts.destroy', [$discussion, $post]) }}"
                                    method="POST" class="inline-block"
                                    onsubmit="return confirm('{{ trans('forum::messages.posts.delete') }}')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-error" title="{{ trans('messages.actions.delete') }}"
                                        data-bs-toggle="tooltip">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        @if (!$discussion->is_locked || auth()->user()?->isAdmin())
            @can('create', \Azuriom\Plugin\Forum\Models\Post::class)
                <div class="flex flex-col w-full bg-base-300 rounded-lg mt-8 p-2">
                    <div class="card-title">
                        <span class="h5">{{ trans('forum::messages.discussions.respond') }}</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('forum.discussions.posts.store', $discussion) }}" method="POST">
                            @csrf

                            <input type="hidden" name="pending_id" value="{{ $pendingId }}">

                            @include('forum::elements.markdown-editor', [
                                'editorMinHeight' => 150,
                                'imagesUploadUrl' => route('forum.posts.attachments.pending', $pendingId),
                            ])

                            <div class="mb-3">
                                <label class="form-label" for="content">{{ trans('messages.fields.content') }}</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4"></textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-reply"></i> {{ trans('forum::messages.discussions.respond') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endcan
        @endif
    </div>
@endsection
