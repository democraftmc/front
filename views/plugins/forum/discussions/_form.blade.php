@csrf

<div class="mb-3">
    <label for="titleInput" class="input input-bordered flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70" viewBox="0 0 512 512"><path d="M469.3 19.3l23.4 23.4c25 25 25 65.5 0 90.5l-56.4 56.4L322.3 75.7l56.4-56.4c25-25 65.5-25 90.5 0zM44.9 353.2L299.7 98.3 413.7 212.3 158.8 467.1c-6.7 6.7-15.1 11.6-24.2 14.2l-104 29.7c-8.4 2.4-17.4 .1-23.6-6.1s-8.5-15.2-6.1-23.6l29.7-104c2.6-9.2 7.5-17.5 14.2-24.2zM249.4 103.4L103.4 249.4 16 161.9c-18.7-18.7-18.7-49.1 0-67.9L94.1 16c18.7-18.7 49.1-18.7 67.9 0l19.8 19.8c-.3 .3-.7 .6-1 .9l-64 64c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l64-64c.3-.3 .6-.7 .9-1l45.1 45.1zM408.6 262.6l45.1 45.1c-.3 .3-.7 .6-1 .9l-64 64c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l64-64c.3-.3 .6-.7 .9-1L496 350.1c18.7 18.7 18.7 49.1 0 67.9L417.9 496c-18.7 18.7-49.1 18.7-67.9 0l-87.4-87.4L408.6 262.6z"/></svg>
        <input type="text" type="text" class="grow @error('title') grow-error @enderror" id="titleInput" name="title" placeholder="Titre de votre post"
        value="{{ old('title', $discussion->title ?? '') }}" required/>
    </label>

    @error('title')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="content">{{ trans('messages.fields.content') }}</label>
    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4">{{ old('content', $discussionContent ?? '') }}</textarea>

    @error('content')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

@canany(['forum.discussions', 'forum.tags'])
    <label class="form-label">{{ trans('forum::messages.fields.tags') }}</label>

    <div class="flex flex-col gap-2 mb-2">
        @foreach ($tags as $tag)
            <div class="flex gap-2">
                    <input type="checkbox" class="checkbox" id="tag{{ $tag->id }}"
                        name="tags[{{ $tag->id }}]" @checked(isset($discussion) && $discussion->tags->contains($tag->id))>
                    <label class="form-check-label" for="tag{{ $tag->id }}">
                        <span class="badge" style="{{ $tag->getBadgeStyle() }}">
                            {{ $tag->name }}
                        </span>
                    </label>
            </div>
        @endforeach
    </div>

    <div class="flex gap-2">
        <input type="checkbox" class="checkbox checkbox-warning" id="pinSwitch" name="is_pinned"
            @checked($discussion->is_pinned ?? false)>
        <label class="pb-1" for="pinSwitch">{{ trans('forum::messages.discussions.pin') }}</label>
    </div>

    <div class="flex gap-2">
        <input type="checkbox" class="checkbox checkbox-error" id="lockSwitch" name="is_locked"
            @checked($discussion->is_locked ?? false)>
        <label class="pb-1" for="lockSwitch">{{ trans('forum::messages.discussions.lock') }}
    </div>
@endcan
