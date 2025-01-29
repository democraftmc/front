<div class="card max-sm:card-compact bg-base-100 w-full shadow-xl">
    <figure>
        <img src="{{ isset($staff->image) && $staff->image != null ? image_url('../staff/' . $staff->image) : (game()->name() === 'Minecraft' ? 'https://mc-heads.net/avatar/' . $staff->name . '/100' : '') }}"
            alt="{{ $staff->name }}" />
    </figure>
    <div class="card-body">
        <h2 class="card-title pixel text-xs md:text-sm">{{ $staff->name }}</h2>
        @if ($staff->tags->count() >= 1)
            @foreach ($staff->tags as $tag)
                <span class="badge badge-lg mt-2"
                    style="background-color: {{ $tag->color }}">{{ $tag->name }}</span>
            @endforeach
        @endif
        @if (!empty($staff->description))
            <p>{!! $staff->description !!}</p>
        @endif
        <div class="card-actions justify-end">
            @if ($staff->links->count() >= 1)
                @foreach ($staff->links as $link)
                    <a href="{{ $link->url }}" title="{{ $link->name }}" target="_blank"
                        class="link link-hover">
                        @if (\Illuminate\Support\Str::contains($link->icon, '<i'))
                            {!! $link->icon !!} {{$link->name}}
                        @else
                            <i class="{{ $link->icon }}"></i> {{$link->name}}
                        @endif
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>
