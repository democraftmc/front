@extends('forum::layouts.forum', ['withSearch' => true])

@section('title', $forum->name)

@section('forum')
    
            @if (!$forum->forums->isEmpty())
                <div class="card mb-4">
                    <div class="list-group list-group-flush">
                        @foreach ($forum->forums as $subForum)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-xl-1 col-md-2 col-2 text-center">
                                        <i class="{{ $subForum->icon ?? 'bi bi-chat' }} fs-2 text-primary"></i>
                                    </div>

                                    <div class="col-xl-8 col-md-7 col-10 ps-md-0">
                                        <h3 class="h5">
                                            <a href="{{ route('forum.show', $subForum->slug) }}">{{ $subForum->name }} E</a>
                                        </h3>

                                        {{ $subForum->description ?? '' }}
                                    </div>

                                    <div class="col-xl-3 col-md-3 d-none d-md-block">
                                        {{ trans_choice('forum::messages.forums.discussions', $subForum->discussions_count) }}
                                        <br>
                                        {{ trans_choice('forum::messages.discussions.posts', $subForum->posts_count) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-2 pt-4">
                @foreach ($forum->discussions as $discussion)
                    <div class="w-full flex bg-base-300 p-2 px-4 rounded-lg">
                        <div class="inline-flex justify-start md:w-1/2">
                            <a>
                                <i class="fa-solid fa-comment text-primary text-4xl mr-4"></i>
                            </a>
                            <div>
                                <a href="{{ route('forum.discussions.show', $discussion) }}" class="text-lg font-bold">
                                    @if ($discussion->is_pinned)
                                        <i class="badge badge-warning fa-solid fa-thumbtack"></i>
                                    @endif
                                    @if ($discussion->is_locked)
                                        <i class="badge badge-error fa-solid fa-lock"></i>
                                    @endif
                                    @foreach ($discussion->tags as $tag)
                                        <span class="badge" style="{{ $tag->getBadgeStyle() }}">{{ $tag->name }}</span>
                                    @endforeach
                                    {{ $discussion->title }}
                                </a>
                                <a href="{{ route('forum.users.show', $discussion->author) }}" class="flex">
                                    <img class="rounded h-4 w-4 translate-y-0.5 mr-1" src="https://api.creepernation.net/avatar/{{ $discussion->author->name }}" alt="{{ $discussion->author->name }}'s Avatar" />
                                    <span>{{ $discussion->author->name }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="inline-flex justify-center hidden md:flex md:w-1/2">
                            {{ format_date($discussion->created_at, true) }}
                            {{ trans_choice('forum::messages.discussions.posts', $discussion->posts_count) }}
                        </div>
                    </div>
                @endforeach
            </div>

    {{ $forum->discussions->links() }}

    @if ($forum->is_locked)
        <div class="alert alert-warning" role="alert">
            <i class="bi bi-lock"></i> {{ trans('forum::messages.forums.locked') }}
        </div>
    @endif

    @can('create', [\Azuriom\Plugin\Forum\Models\Discussion::class, $forum])
        <a href="{{ route('forum.forum.discussions.create', $forum->slug) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> {{ trans('messages.actions.create') }}
        </a>
    @endcan
@endsection
