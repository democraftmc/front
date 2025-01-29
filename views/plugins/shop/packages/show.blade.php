<div class="modal-box relative">
    <form method="dialog">
      <button class="btn btn-circle btn-ghost absolute right-4 top-4">✕</button>
    </form>
    <h3 class="text-lg font-bold">{{ $package->name }}</h3>
    <p class="py-4">{!! $package->description !!}</p>
    <span class="flex-md-fill font-weight-bold">
        @if($package->isDiscounted())
            <del class="small">{{ shop_format_amount($package->getOriginalPrice()) }}</del>
        @endif
        {{ shop_format_amount($package->getPrice()) }}
    </span>

    @auth
        @if($package->isSubscription())
            @if($package->isUserSubscribed())
                <a href="{{ route('shop.profile') }}" class="btn btn-primary">
                    {{ trans('shop::messages.actions.manage') }}
                </a>
            @else
                <form action="{{ route('shop.subscriptions.select', $package) }}" method="POST" class="form-inline">
                    @csrf

                    <button type="submit" class="btn btn-primary">
                        {{ trans('shop::messages.actions.subscribe') }}
                    </button>
                </form>
            @endif
        @elseif($package->isInCart())
            <form action="{{ route('shop.cart.remove', $package) }}" method="POST" class="form-inline">
                @csrf

                <button type="submit" class="btn btn-primary">
                    {{ trans('messages.actions.remove') }}
                </button>
            </form>
        @elseif($package->getMaxQuantity() < 1)
            {{ trans('shop::messages.packages.limit') }}
        @elseif(! $package->hasBoughtRequirements())
            {{ trans('shop::messages.packages.requirements') }}
        @else
            <form action="{{ route('shop.packages.buy', $package) }}" method="POST" class="row row-cols-lg-auto g-0 gy-2 align-items-center">
                @csrf

                @if($package->custom_price)
                    <label for="price">{{ trans('shop::messages.fields.price') }}</label>

                    <div class="mx-3">
                        <input type="number" min="{{ $package->getPrice() }}" size="5" class="form-control" name="price" id="price" value="{{ $package->price }}">
                    </div>
                @endif

                @if($package->has_quantity)
                    <label for="quantity">{{ trans('shop::messages.fields.quantity') }}</label>

                    <div class="mx-3">
                        <input type="range" min="1" max="{{ $package->getMaxQuantity() }}" class="range" step="1" name="quantity" id="quantity" value="1" required/>
                        <div class="flex w-full justify-between px-2 text-xs">
                        <span>|</span>
                        <span>|</span>
                        <span>|</span>
                        <span>|</span>
                        <span>|</span>
                        </div>
                        <input type="number" min="1" max="{{ $package->getMaxQuantity() }}" size="5" class="input input-bordered w-full" name="quantity" id="quantity" value="1" required>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">
                    {{ trans('shop::messages.buy') }}
                </button>
            </form>
        @endif
    @else
        <div class="alert alert-info" role="alert">
            {{ trans('shop::messages.cart.guest') }}
        </div>
    @endauth
  </div>
