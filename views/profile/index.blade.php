@extends('layouts.app')

@section('title', trans('messages.profile.title'))

@section('content')
    <div class="bg-base-100 p-4 pt-10">
        <div class="card bg-base-200 p-4 flex flex-col">
            <img src="https://api.creepernation.net/avatar/{{ Auth::user()->name }}" class="md:hidden w-full rounded-xl" />
            <div class="grid grid-cols-4 md:grid-cols-10 w-full">
                <img src="https://api.creepernation.net/avatar/{{ Auth::user()->name }}"
                    class="hidden md:flex rounded-lg w-32 h-32" />
                <div class="max-sm:p-4 pt-1 pb-0 col-span-3">
                    <h1 class="text-sm md:text-base pixel font-black">{{ $user->name }}</h1>
                    <span class="mt-5 badge badge-lg" style="{{ $user->role->getBadgeStyle() }};">
                        @if ($user->role->icon)
                            <i class="{{ $user->role->icon }}"></i>
                        @endif {{ $user->role->name }}
                    </span>
                    <p class="mt-2"><i class="fa fa-coins"></i> 10123</p>
                    @if ($discordAccount !== null)
                        <p><i class="fa-brands fa-discord"></i> @{{ trans('messages.profile.info.discord', ['user' => $discordAccount - > name]) }}</p>
                    @endif
                </div>
                <div class="flex col-span-4 md:flex-col gap-1 md:col-start-9 flex-wrap justify-center">
                    @if (!oauth_login())
                        @if ($user->hasTwoFactorAuth())
                            <a class="btn btn-neutral" href="{{ route('profile.2fa.index') }}"><i class="fa-solid fa-shield-halved"></i> {{ trans('messages.profile.2fa.manage') }}</a>
                        @else
                            <a class="btn btn-neutral" href="{{ route('profile.2fa.index') }}"><i class="fa-solid fa-shield-halved"></i> {{ trans('messages.profile.2fa.enable') }}</a>
                        @endif
                        @if($canDelete)
                            <a class="btn btn-error" href="{{ route('profile.delete.index') }}"><i class="fa-solid fa-user-xmark" href="{{ route('profile.delete.index') }}"></i> {{ trans('messages.profile.delete.btn') }}</a>
                        @endif
                        @if ($enableDiscordLink)
                            @if ($discordAccount !== null)
                                <form action="{{ route('profile.discord.unlink') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button type="submit"
                                        class="btn text-white border-0 bg-indigo-600 hover:bg-indigo-800">
                                        <i class="fa-brands fa-discord"></i>
                                        {{ trans('messages.profile.discord.unlink') }}</button>
                                </form>
                            @else
                                <a class="btn text-white border-0 bg-indigo-600 hover:bg-indigo-800">
                                    <i class="fa-brands fa-discord"></i>
                                    {{ trans('messages.profile.discord.link') }}</a>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="card bg-base-200 p-4">
                <h2 class="card-title">{{ trans('messages.profile.change_email') }}</h2>
                <form class="mt-2" action="{{ route('profile.email') }}" method="POST">
                    <label class="form-control my-2">
                        <input type="text" class="input input-bordered @error('email') input-error @enderror"
                            id="emailInput" name="email" value="{{ old('email', $user->email ?? '') }}" required />
                    </label>
                    @if (!oauth_login())
                        <label class="form-control mt-2">
                            <input type="text" class="input input-bordered" id="emailConfirmPassInput"
                                name="email_confirm_pass" required />
                        </label>
                    @endif
                    <button class="btn btn-success mt-2"> {{ trans('messages.actions.update') }}</button>
                </form>
            </div>
            @if (!oauth_login())
                <div class="card bg-base-200 p-4">
                    <h2 class="card-title">{{ trans('messages.profile.change_password') }}</h2>
                    <form class="mt-2" action="{{ route('profile.password') }}" method="POST">
                        <label class="form-control my-2">
                            <input type="password" class="input input-bordered" />
                        </label>
                        <div class="flex">
                            <label class="form-control mt-2 w-1/2">
                                <input type="password" class="input input-bordered rounded-r-none" />
                            </label>
                            <label class="form-control mt-2 w-1/2">
                                <input type="password" class="input input-bordered rounded-l-none" />
                            </label>
                        </div>
                        <button class="btn btn-success mt-2"> {{ trans('messages.actions.update') }}</button>
                    </form>
                </div>
            @endif
            @if ($canChangeName)
                <div class="card bg-base-200 p-4">
                    <h2 class="card-title">{{ trans('messages.profile.change_name') }}</h2>
                    <form class="mt-2 flex flex-col">
                        <div class="join">
                            <label class="join-item form-control maw-w-xs">
                                <input type="text" class="input input-bordered md:rounded-r-none"id="nameInput"
                                    name="name" value="{{ old('name', $user->name ?? '') }}" required />
                                <div class="label">
                                    <span class="label-text-alt">Essayer au maximum de faire correspondre votre pseudo avec
                                        celui en jeu.</span>
                                </div>
                            </label>
                            <button
                                class="join-item btn btn-success max-sm:hidden">{{ trans('messages.actions.update') }}</button>
                        </div>
                        <button class="join-item btn btn-success sm:hidden">{{ trans('messages.actions.update') }}</button>
                    </form>
                </div>
            @endif
            @if ($canUploadAvatar)
                <div class="card bg-base-200 p-4">
                    <h2 class="card-title">{{ trans('messages.profile.change_avatar') }}</h2>
                    <form class="mt-2 flex flex-col" action="{{ route('profile.avatar') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="join">
                            <label class="join-item form-control">
                                <input type="file"
                                    class="file-input file-input-sm md:file-input-md file-input-bordered md:rounded-r-none"
                                    id="imageInput" name="image" accept=".jpg,.jpeg,.jpe,.png,.gif" required />
                                <div class="label">
                                    <span
                                        class="label-text-alt">{{ trans('messages.profile.avatar', ['size' => '64x64']) }}</span>
                                </div>
                            </label>
                            <button
                                class="join-item btn btn-success max-sm:hidden">{{ trans('messages.actions.save') }}</button>
                        </div>
                        <button class="join-item btn btn-success sm:hidden">{{ trans('messages.actions.save') }}</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
