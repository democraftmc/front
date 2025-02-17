<div class="navbar hidden md:flex fixed border-b backdrop-blur border-base-300 z-30 bg-black/15 dark:bg-white/15">
    <div class="navbar-start">
        <a href="/" class="text-xs pixel font-bold flex items-center">
            <img src="https://us-east-1.tixte.net/uploads/cdn.democraft.fr/logo.png"
                class="w-10 h-10 rounded-lg hover:scale-110 transition-all ease-in-out duration-300 mr-2" />
            <span class="relative bottom-1">DEMOCRAFT</span></a>
    </div>
    <div class="navbar-center">
        <ul class="menu menu-horizontal px-1">
            @foreach ($navbar as $element)
                @if (!$element->isDropdown())
                    <li><a href="{{ $element->getLink() }}">{{ $element->name }}</a></li>
                @else
                    <li><a href="/vote">Vote</a></li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="navbar-end">
        <div class="inline-block relative mr-2 w-10">
            <button data-toggle-theme="light,dark"
                class="relative flex items-center justify-center w-10 h-10 btn-ghost rounded">
                <!-- First SVG icon (bottom layer) -->
                <svg class="opacity-0 dark:opacity-100 absolute fill-current w-6 h-6 transition-all duration-500"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z">
                    </path>
                </svg>

                <!-- Second SVG icon (top layer) -->
                <svg class="absolute dark:opacity-0 opacity-100 fill-current w-6 h-6 transition-all duration-500"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z">
                    </path>
                </svg>
            </button>
        </div>

        <div class="dropdown dropdown-end">
            @guest
                @if (Route::has('register'))
                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> Compte</a>
                @endif
            @else
                <div tabindex="0" role="button" class="flex items-center">
                    <p class="mr-2">{{ Auth::user()->name }}</p>
                    <img class="rounded-lg w-10 h-10 hover:scale-110 transition-all ease-in-out duration-300"
                        src="https://api.creepernation.net/avatar/{{ Auth::user()->name }}" />
                </div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow mt-6">
                    <li>
                        <a href="{{ route('profile.index') }}"><i class="fa-solid fa-user-pen"></i> Mon Compte</a>
                    </li>
                    @foreach (plugins()->getUserNavItems() ?? [] as $navId => $navItem)
                        <li><a href="{{ route($navItem['route']) }}"><i class="fa-solid fa-bag-shopping"></i>
                                {{ trans($navItem['name']) }}</a></li>
                    @endforeach
                    @if (Auth::user()->hasAdminAccess())
                        <li>
                            <a class="link-info" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gears"></i>
                                {{ trans('messages.nav.admin') }}</a>
                        </li>
                    @endif
                    <li>
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="link-error"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endguest
        </div>

    </div>
</div>
