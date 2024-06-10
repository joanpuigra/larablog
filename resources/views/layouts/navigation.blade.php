<nav x-data="{ open: false }" class="bg-red-500 text-white">
    <!-- Primary Navigation Menu -->
        <div class="flex justify-between items-center h-16">
            <div class="flex m-2 justify-start">
                <!-- Navigation Links -->
                <div class="flex flex-row gap-4 font-bold">
                    <x-nav-link class="text-white font-bold text-xl border-none hover:text-red-900" :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                        <h1 class="text-4xl">{{ __('Larablog') }}</h1>
                    </x-nav-link>
                    <!-- <x-nav-link class="text-white font-bold text-xl border-none hover:text-red-900" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link> -->
                </div>
            </div>

            <!-- Login -->
            @guest
            <div class="flex flex-row">
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('login') }}" class="text-white font-bold text-3xl mr-4 hover:text-red-900">Login</a>
                </div>
                <div>
                    <a href="{{ route('register') }}" class="text-white font-bold text-3xl mr-4 hover:text-red-900">Register</a>
                </div>
            </div>
            @endguest

            <!-- Settings Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent leading-4 rounded-md text-white font-bold text-3xl bg-red-500 hover:text-red-900 focus:outline-none transition ease-in-out duration-150">
                            <div>{{  Auth::user() ? Auth::user()->name : Auth::user() }}</div>

                            <div class="ms-1">
                                <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg> -->
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-base-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-red-900">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user() ? Auth::user()->name : Auth::user() }}</div>
                <div class="font-medium text-sm text-gray-300">{{ Auth::user() ? Auth::user()->name : Auth::user() }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-white">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
