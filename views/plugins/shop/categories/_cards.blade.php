<div class="flex flex-col gap-y-4 justify-center min-w-full">
    <a href="{{ route('shop.cart.index') }}" class="btn btn-primary ">
        <i class="fa-solid fa-cart-shopping"></i> {{ trans('shop::messages.cart.title') }}
    </a>
    <a href="{{ route('shop.profile') }}" class="btn btn-secondary">
        <i class="fa-solid fa-piggy-bank"></i> {{ trans('shop::messages.profile.payments') }}
    </a>
</div>

{{$goal}}
@if($goal > 0)
    <div class="card mb-4">
        <div class="card-header">
            <i class="bi bi-graph-up"></i> {{ trans('shop::messages.goal.title') }}
        </div>
        <div class="card-body">
            <div class="progress mb-1">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $goal }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ min($goal, 100) }}%"></div>
            </div>

            <p class="card-text text-center">
                {{ trans_choice('shop::messages.goal.progress', $goal) }}
            </p>
        </div>
    </div>
@endif

@if($topCustomer !== null)
    <div class="card mb-4">
        <div class="card-header">
            <i class="bi bi-star"></i> {{ trans('shop::messages.top.title') }}
        </div>
        <div class="card-body d-flex">
            <div class="flex-shrink-0">
                <img class="me-3 rounded" src="{{ $topCustomer->user->getAvatar(64) }}" alt="{{ $topCustomer->user->name }}" width="64">
            </div>
            <div class="flex-grow-1">
                <p class="h4 mb-1">{{ $topCustomer->user->name }}</p>
                @if($displaySidebarAmount)
                    {{ $topCustomer->total.' '.currency_display() }}
                @endif
            </div>
        </div>
    </div>
@endif

@if($recentPayments !== null)
    <div class="card mb-4">
        <div class="card-header">
            <i class="bi bi-list-check"></i> {{ trans('shop::messages.recent.title') }}
        </div>
        <div class="list-group list-group-flush">
            @forelse($recentPayments as $payment)
                <div class="list-group-item d-flex">
                    <div class="flex-shrink-0 d-flex align-items-center">
                        <img src="{{ $payment->user->getAvatar(48) }}" class="me-3 rounded" alt="{{ $payment->user->name }}" width="32">
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1">{{ $payment->user->name }}</p>
                        <small>
                            @if($displaySidebarAmount)
                                {{ $payment->price.' '.currency_display() }} -
                            @endif
                            {{ format_date($payment->created_at) }}
                        </small>
                    </div>
                </div>
            @empty
                <div class="list-group-item">
                    {{ trans('shop::messages.recent.empty') }}
                </div>
            @endforelse
        </div>
    </div>
@endif
