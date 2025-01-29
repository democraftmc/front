<p class="bg-base-100 text-center pixel pt-6 pb-8">Articles</p>
<div class="grid grid-cols-2 md:grid-cols-5 bg-base-100 gap-y-6 md:gap-x-6 p-4 pt-6">
    @foreach ($posts as $post)
        @if ($loop->first)
            <div class="row-span-2 col-span-2 card card-compact bg-base-300 md:mb-6">
                <figure class="max-h-64">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title text-2xl">
                        {{ $post->title }}
                    </h2>
                    <p class="text-lg">
                        {{ Str::limit(strip_tags($post->content), 500) }}
                    </p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">{{ trans('messages.posts.read') }}</a>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <div class="grid grid-cols-1 md:grid-cols-2 col-span-3 gap-6">
        @foreach ($posts->slice(1, 4) as $post)
            <div class="card card-compact card-side bg-base-300">
                <figure class="w-1/2">
                    <img class="object-cover h-full" src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" />
                </figure>
                <div class="card-body w-1/2">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p>
                        {{ Str::limit(strip_tags($post->content), 130) }}
                    </p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-secondary">Lire la suite</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
