@extends('layouts.app')

@section('title', trans('vote::messages.title'))

@section('content')
    <div class="bg-base-100 p-4 pt-10">
        <div class="d-none alert alert-info" role="alert" id="status-message">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 mx-2 lg:mx-6 gap-y-4 md:gap-4">

            <div class="card bg-base-200 p-4 flex justify-center min-w-full relative" id="vote-card">

                <div class="spinner-parent absolute left-0 h-full w-full"></div>
                <h1 class="text-center text-4xl font-bold">Voter</h1>

                <div class="@auth d-none @endauth" data-vote-step="1">
                    <form class="flex flex-col justify-center" action="{{ route('vote.verify-user', '') }}" id="voteNameForm">
                        <label class="input input-bordered flex items-center gap-2 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="h-4 w-4 opacity-70">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z">
                                </path>
                            </svg>
                            <input class="grow" type="text" id="stepNameInput" name="name" class="form-control"
                                value="{{ $name }}" placeholder="{{ trans('messages.fields.name') }}" required />
                        </label>
                        <button type="submit" class="btn btn-primary mt-2">
                            {{ trans('messages.actions.continue') }}
                            <span class="d-none load-spinner loading loading-infinity loading-lg" role="status"></span>
                        </button>
                    </form>
                    <p class="text-sm pt-2 text-center">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Attention ! Vérifiez que votre nom est identique sur le site et en jeu
                    </p>
                </div>

                <div class="@guest d-none @endguest mt-2 flex flex-col justify-center gap-2" data-vote-step="2" id="vote_buttons">
                    @forelse($sites as $site)
                        <a class="btn btn-primary" href="{{ $site->url }}" target="_blank"
                            rel="noopener noreferrer nofollow" data-vote-id="{{ $site->id }}"
                            data-vote-url="{{ route('vote.vote', $site) }}"
                            @auth data-vote-time="{{ $site->getNextVoteTime($user, $request)?->valueOf() }}" @endauth>
                            <span class="d-none badge border-0 bg-secondary text-white vote-timer"></span> {{ $site->name }}
                        </a>
                    @empty
                        <div class="alert alert-warning" role="alert">
                            <span>{{ trans('vote::messages.errors.site') }}
                            </span>
                        </div>
                    @endforelse
                </div>

                <div class="hidden alert alert-info" data-vote-step="3">
                    <p id="vote-result">
                    </p>
                </div>
                
            </div>
            <div class="card bg-base-200 p-4 col-span-2 row-span-3">
                <h1 class="text-center text-4xl font-bold">Classement</h1>
                <div class="grid md:grid-cols-2 mt-4">
                    <div>
                        <h2 class="text-2xl font-bold">Top Voteurs</h2>
                        <p class="text-lg mt-2">
                            Chaque mois, le classement des votes est réinitialisé. Les 3
                            premiers joueurs recevront alors une récompenses.
                            <br />
                            N'oubliez pas que chaque vote vous offre une récompense !
                        </p>
                        <p class="text-sm mt-2">
                            <i class="fa-solid fa-circle-question"></i>
                            Quelle récompense ? Regardez à gauche !
                        </p>
                    </div>
                    <div></div>
                </div>
                <div class="overflow-x-auto mt-4">
                    <table class="table">
                        <thead>
                            <tr class="bg-base-300">
                                <th class="rounded-l-xl">Rang</th>
                                <th>Pseudo</th>
                                <th class="rounded-r-xl">Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($votes as $id => $vote)
                                <tr>
                                    <td>#{{ $id }}</td>
                                    <td class="flex text-lg items-center">
                                        <img class="rounded-lg h-12 w-12" src="https://api.creepernation.net/avatar/{{ $vote->user->name }}"
                                            alt="{{ $vote->user->name }}'s Avatar" />
                                        <p class="pl-2">{{ $vote->user->name }}</p>
                                    </td>
                                    <td>{{ $vote->votes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($displayRewards)
            <div class="card bg-base-200 p-4 min-w-full">
                <h1 class="text-center text-4xl font-bold">Récompenses</h1>
                <div class="overflow-x-auto mt-4">
                    <table class="table">
                        <thead>
                            <tr class="bg-base-300">
                                <th class="rounded-l-xl">Nom</th>
                                <th class="rounded-r-xl">Probabilité</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rewards as $reward)
                                <tr>
                                    <td>
                                        @if ($reward->image)
                                        @endif
                                        {{ $reward->name }}
                                    </td>
                                    <td>{{ $reward->chances }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection


@push('scripts')
    @if($ipv6compatibility)
        <script src="https://ipv6-adapter.com/api/v1/api.js" async defer></script>
    @endif

    <script src="{{ theme_asset('vote.js') }}" defer></script>
    @auth
        <script>
            window.username  = '{{ $user->name }}';
        </script>
    @endauth
@endpush

@push('styles')
    <style>
        #vote-card .spinner-parent {
            display: none;
        }

        #vote-card.voting .spinner-parent {
            position: absolute;
            display: flex;
        }
    </style>
@endpush
