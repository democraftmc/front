@extends('layouts.app', ['noBar' => true])

@section('title', trans('auth.login'))

@section('content')
    @error('email')
        <div class="alert alert-error" role="alert">
            {{ $message }}
        </div>
    @enderror
    @error('password')
        <div class="alert alert-error" role="alert">
            {{ $message }}
        </div>
    @enderror
    <div class="flex justify-center pb-10">
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body justify-center">
                <h2 class="card-title justify-center text-2xl font-bold">
                    {{ trans('auth.login') }}
                </h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">{{ trans('auth.email') }}</span>
                        </label>
                        <label class="input input-bordered flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="w-4 h-4 opacity-70">
                                <path
                                    d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z">
                                </path>
                                <path
                                    d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z">
                                </path>
                            </svg>
                            <input id="email" type="text" class="grow" name="email" value="{{ old('email') }}"
                                required autocomplete="email" autofocus />
                        </label>
                    </div>
                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text">Mot de Passe</span>
                        </label>
                        <label class="input input-bordered flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="w-4 h-4 opacity-70">
                                <path fill-rule="evenodd"
                                    d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <input class="grow" id="password" type="password" name="password" required
                                autocomplete="current-password" />
                        </label>
                        <label class="label">
                            @if (Route::has('password.request'))
                                <a lass="label-text-alt link link-hover" href="{{ route('password.request') }}">
                                    {{ trans('auth.forgot_password') }}
                                </a>
                            @endif
                        </label>
                        <div class="flex gap-2">
                            <input class="checkbox checkbox-primary" type="checkbox" name="remember" id="remember"
                                @checked(old('remember')) />
                            <label class="pb-1" for="remember"> {{ trans('auth.remember') }}</label>
                        </div>
                    </div>
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary"> {{ trans('auth.login') }} </button>
                    </div>
                </form>
                <div class="divider">OU</div>
                <a href="{{ route('register') }}" class="btn">{{ trans('auth.register') }}</a>
            </div>
        </div>
    </div>

@endsection
