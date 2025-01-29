@extends('layouts.app', ['noBar' => true])

@section('title', trans('auth.register'))

@section('content')

@error('name')
    <div class="alert alert-error" role="alert">
        {{ $message }}
    </div>
@enderror

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

@error('conditions')
    <div class="alert alert-error" role="alert">
        {{ $message }}
    </div>
@enderror

<div class="flex justify-center pb-10">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body justify-center">
            <h2 class="card-title justify-center text-2xl font-bold">
                {{ trans('auth.register') }}
            </h2>
            <form method="POST" action="{{ route('register') }}" id="captcha-form">
                    @csrf
                    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">{{ trans('auth.name') }}</span>
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
                            <input id="name" type="text" class="grow" name="name" value="{{ old('name') }}"
                                required autocomplete="name" autofocus />
                        </label>
                    </div>

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


                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">{{ trans('auth.password') }}</span>
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
                            <input id="password" type="password" class="grow" name="password"
                                required autofocus  />
                        </label>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">{{ trans('auth.confirm_password') }}</span>
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
                            <input id="password-confirm" type="password" class="grow" name="password-confirm"
                                required autofocus  />
                        </label>
                    </div>


                    @if($registerConditions !== null)
                    <div class="flex flex-row p-2 w-full">
                        <input class="checkbox checkbox-primary mr-2 @error('conditions') is-invalid @enderror" type="checkbox" name="conditions" id="conditions" required @checked(old('conditions'))>
                        <div class="prose ">{{ $registerConditions }}</div>
                    </div>
                    @endif

                    @include('elements.captcha', ['center' => true])

                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary"> {{ trans('auth.register') }} </button>
                    </div>
                </form>
                <div class="divider">OU</div>
                <a href="{{ route('login') }}" class="btn">{{ trans('auth.login') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
