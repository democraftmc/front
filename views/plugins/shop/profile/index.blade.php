@extends('layouts.app')

@section('title', trans('shop::messages.profile.payments'))

@section('content')
    <div class="bg-base-100 p-4 pt-10">
        <table class="table">
            <thead>
                <tr class="bg-base-300">
                    <th class="rounded-l-xl">{{ trans('shop::messages.fields.price') }}</th>
                    <th>{{ trans('messages.fields.type') }}</th>
                    <th class="rounded-r-xl">{{ trans('messages.fields.date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>
                            {{ $payment->formatPrice() }}
                            <br/>
                            <span class="badge">
                                {{ $payment->transaction_id ?? trans('messages.unknown') }}
                            </span>
                            <span class="badge bg-{{ $payment->statusColor() }}">
                                {{ trans('shop::admin.payments.status.'.$payment->status) }}
                            </span>
                        </td>
                        <td>{{ $payment->getTypeName() }}</td>
                        <td>{{ format_date($payment->created_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    @if(! $subscriptions->isEmpty())
        <h1 class="text-center text-4xl font-bold">{{ trans('shop::messages.profile.subscriptions') }}</h1>
        <table class="table">
            <thead>
                <tr class="bg-base-300">
                    <th scope="col">#</th>
                    <th scope="col">{{ trans('shop::messages.fields.price') }}</th>
                    @if(! use_site_money())
                        <th scope="col">{{ trans('messages.fields.type') }}</th>
                    @endif
                    <th scope="col">{{ trans('shop::messages.fields.package') }}</th>
                    <th scope="col">{{ trans('messages.fields.status') }}</th>
                    <th scope="col">{{ trans('shop::messages.fields.subscription_id') }}</th>
                    <th scope="col">{{ trans('messages.fields.date') }}</th>
                    <th scope="col">{{ trans('shop::messages.fields.renewal_date') }}</th>
                    <th scope="col">{{ trans('messages.fields.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $subscription)
                <tr>
                    <th scope="row">{{ $subscription->id }}</th>
                    <td>{{ $subscription->formatPrice() }}</td>
                    @if(! use_site_money())
                        <td>{{ $subscription->getTypeName() }}</td>
                    @endif
                    <td>{{ $subscription->package?->name ?? trans('messages.unknown') }}</td>
                    <td>
                        <span class="badge bg-{{ $subscription->statusColor() }}">
                            {{ trans('shop::admin.subscriptions.status.'.$subscription->status) }}
                        </span>
                    </td>
                    <td>{{ $subscription->subscription_id ?? trans('messages.unknown') }}</td>
                    <td>{{ format_date($subscription->created_at) }}</td>
                    <td>{{ format_date($subscription->ends_at) }}</td>
                    <td>
                        @if($subscription->isActive() && ! $subscription->isCanceled())
                            <form action="{{ route('shop.subscriptions.destroy', $subscription) }}" method="POST">
                                @method('DELETE')
                                @csrf

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-x-circle"></i> {{ trans('messages.actions.cancel') }}
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @endif

    @if(use_site_money())
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ trans('shop::messages.giftcards.add') }}</h2>

                <form action="{{ route('shop.giftcards.add') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <input type="text" class="form-control @error('code') is-invalid @enderror" placeholder="{{ trans('shop::messages.fields.code') }}" id="code" name="code" value="{{ old('code', $giftCardCode) }}">

                        @error('code')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ trans('messages.actions.send') }}
                    </button>
                </form>
            </div>
        </div>
    @endif

    </div>
@endsection
