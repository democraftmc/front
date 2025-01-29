@extends('layouts.base')

@section('app')
<div>
    <div class="hero banner-hero relative indicator justify-center min-w-full">
        <span class="indicator-item indicator-bottom indicator-center badge badge-primary pixel pt-4 pb-7 px-4">
        Blog
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
    @yield('content')
</div>
@endsection