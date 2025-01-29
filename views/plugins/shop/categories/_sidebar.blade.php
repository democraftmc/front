<div class="flex justify-center min-w-full">
    <ul class="menu bg-base-200 w-56 p-0 rounded-lg min-w-full">
        @if ($displayHome)
            <li>
                <a href="{{ route('shop.home') }}" class="@if ($category === null) active @endif">
                    <i class="fa-duotone fa-solid fa-shop"></i> {{ trans('messages.home') }}
                </a>
            </li>
        @endif
        @foreach ($categories as $subCategory)
            <li>
                <a class="@if ($subCategory->is($category)) active @endif"
                    href="{{ route('shop.categories.show', $subCategory) }}">
                    @if($subCategory->icon)
                      <i class="{{ $subCategory->icon }}"></i>
                    @endif
                    {{ $subCategory->name }}
                </a>
            </li>
            @foreach ($subCategory->categories as $cat)
                <a href="{{ route('shop.categories.show', $cat) }}"
                    class="@if ($cat->is($category)) active @endif">
                    @if ($cat->icon)
                        <i class="{{ $cat->icon }}"></i>
                    @endif
                    {{ $cat->name }}
                </a>
            @endforeach
        @endforeach
    </ul>
</div>
