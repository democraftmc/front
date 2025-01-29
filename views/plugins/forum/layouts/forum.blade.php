@extends('layouts.base')

@section('app')
<div>
    <div class="hero banner-hero relative indicator justify-center min-w-full">
        <span class="indicator-item indicator-bottom indicator-center badge badge-primary pixel pt-4 pb-7 px-4">
        Forum
        </span>
        <video autoplay muted loop id="background-video"
            class="object-cover absolute overflow-hidden -z-10 scale-150 md:scale-110 lg:scale-100">
            <source src="{{ theme_asset('video.mp4') }}" type="video/mp4" />
        </video>
        <div class="hero-content text-center p-0">
            <div>
                <img class="h-[77px] lg:h-40 mt-10 lg:mt-20"
                    src="https://us-east-1.tixte.net/uploads/cdn.democraft.fr/title_flat.png" />
            </div>
        </div>
    </div>
</div>
<div class="bg-base-100 p-4 pt-10">
    <div class="p-2 md:px-6 flex flex-col md:flex-row">
        @include('forum::elements.nav')
        @if ($withSearch ?? false)
            <div class="inline-flex justify-center md:justify-end md:w-1/4">
                <form method="GET">
                    <div class="join">
                        <input type="search" id="searchInput" name="search" class="input input-bordered join-item"
                            value="{{ $search ?? '' }}" placeholder="{{ trans('messages.actions.search') }}"
                            placeholder="Search" />
                        <button type="submit" class="btn btn-primary join-item"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        @endif
        @if ($includeEdit ?? false)
            <div class="inline-flex justify-center md:justify-end md:w-1/4 gap-2">
                @can('forum.discussions')
                    <form action="{{ route('forum.discussions.'.($discussion->is_pinned ? 'unpin' : 'pin'), $discussion) }}" method="POST">
                        @csrf
                        <button class="btn btn-success @if($discussion->is_pinned) active @endif" title="{{ trans('forum::messages.actions.'.($discussion->is_pinned ? 'unpin' : 'pin')) }}" data-bs-toggle="tooltip">
                            <i class="fa-solid fa-{{ $discussion->is_pinned ? 'thumbtack' : 'thumbtack'}}"></i>
                        </button>
                    </form>

                    <form action="{{ route('forum.discussions.'.($discussion->is_locked ? 'unlock' : 'lock'), $discussion) }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary @if($discussion->is_locked) active @endif" title="{{ trans('forum::messages.actions.'.($discussion->is_locked ? 'unlock' : 'lock')) }}" data-bs-toggle="tooltip">
                            <i class="fa-solid fa-{{ $discussion->is_locked ? 'unlock' : 'lock'}}"></i>
                        </button>
                    </form>
                @endcan
                @if(! $discussion->is_locked || auth()->user()?->isAdmin())
                    @can('update', $discussion)
                        <a href="{{ route('forum.discussions.edit', $discussion) }}" class="btn btn-info" title="{{ trans('messages.actions.edit') }}" data-bs-toggle="tooltip">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    @endcan

                    @can('delete', $discussion)
                        <form action="{{ route('forum.discussions.destroy', $discussion) }}" method="POST" onsubmit="return confirm('{{ trans('forum::messages.discussions.delete') }}')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-error" title="{{ trans('messages.actions.delete') }}" data-bs-toggle="tooltip">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    @endcan
                @endif
            </div>
        @endif
    </div>
    @yield('forum')
    </div>
@endsection
