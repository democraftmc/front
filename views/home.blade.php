@extends('layouts.empty', ['isHome' => true])

@section('title', trans('messages.home'))
@section('content')
<div class="hero home-hero relative">
  <video
    autoplay
    muted
    loop
    id="background-video"
    class="object-cover absolute overflow-hidden -z-10 scale-150 md:scale-110 lg:scale-100">
    <source src="{{ theme_asset('video.mp4') }}" type="video/mp4" />
  </video>
  <div class="hero-content text-center">
    <div>
      <img
        class="h-16 lg:h-40 mb-2"
        src="https://us-east-1.tixte.net/uploads/cdn.democraft.fr/title_flat.png"
      />
      @if($server)
      @if($server->isOnline())
      <span class="bg-success text-white p-2 rounded-full px-4">
        <span class="text-lg relative"
          >🔥
          <span class="text-lg absolute animate-ping -left-0">🔥</span>
        </span>
        {{$server->getOnlinePlayers()}}
      </span>
      @endif
      @endif
      <br />
      <a href="#1"> <i class="fa-solid fa-arrow-down fa-2xl mt-8"></i></a>
    </div>
  </div>
</div>
@include('elements.arg1')
@include('elements.arg2')
@include('elements.arg3')
@include('elements.news')
@endsection

<div class="w-1/3"></div>
<div class="w-2/3"></div>
<input type="range" min="1" max="{{ $package->getMaxQuantity() }}" class="range" step="1" name="quantity" id="quantity" value="1" required/>