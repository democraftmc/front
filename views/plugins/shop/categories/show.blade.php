@extends('layouts.app')

@section('title', $category->name)

@push('footer-scripts')
    <script>
        document.querySelectorAll('[data-package-url]').forEach(function(el) {
            el.addEventListener('click', function(ev) {
                ev.preventDefault();

                axios.get(el.dataset['packageUrl']).then(function(response) {
                    const itemModal = document.getElementById('itemModal');
                    itemModal.innerHTML = response.data;
                    itemModal.showModal()
                }).catch(function(error) {
                    createAlert('danger', error, true);
                });
            });
        });
    </script>
@endpush

@section('content')
    <div id='status-message'></div>
    <div class="bg-base-100 p-4 pt-10">
        <div class="flex mx-2 lg:mx-6 gap-y-4 md:gap-4">
            <div class="w-1/3">
                @include('shop::categories._sidebar')
                <br />
                @include('shop::categories._cards')
            </div>

            <div class="card bg-base-200 p-4 flex w-2/3">
                @if ($category->description)
                    <article class="prose lg:prose-lg min-w-full">
                        {!! $category->description !!}
                    </article>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                @forelse($category->packages as $package)
                    <div class="card bg-base-300">
                        @if ($package->hasImage())
                            <a href="#" data-package-url="{{ route('shop.packages.show', $package) }}">
                                <figure>
                                    <img src="{{ $package->imageUrl() }}" alt="{{ $package->name }}"/>
                                  </figure>
                            </a>
                        @endif

                        <div class="card-body">
                            <h4 class="card-title">{{ $package->name }}</h4>
                            <div class="badge badge-secondary">
                                @if ($package->isDiscounted())
                                    <del class="small">{{ $package->getOriginalPrice() }}</del>
                                @endif
                                {{ shop_format_amount($package->getPrice()) }}
                            </div>

                            <a href="#" class="btn btn-primary btn-block"
                                data-package-url="{{ route('shop.packages.show', $package) }}">
                                {{ trans('shop::messages.buy') }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-exclamation-circle"></i> {{ trans('shop::messages.categories.empty') }}
                        </div>
                    </div>
                @endforelse
                </div>
            </div>
        </div>
    </div>
 <dialog id="itemModal" class="modal"></dialog>
@endsection
