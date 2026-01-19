<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ trim(strtolower(Auth::user()->role)) == 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" class="block h-9 w-auto fill-current text-gray-800"
                            style="max-width: 90px;" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    @auth
                        @if (trim(strtolower(Auth::user()->role)) == 'admin')
                            {{-- === MENU ADMIN === --}}
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Dashboard Admin') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.alumni.index')" :active="request()->routeIs('admin.alumni.*')">
                                {{ __('Kelola Alumni') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.event.index')" :active="request()->routeIs('admin.event.*')">
                                {{ __('Kelola Event') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.loker.index')" :active="request()->routeIs('admin.loker.*')">
                                {{ __('Kelola Loker') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.kusioner.index')" :active="request()->routeIs('admin.kusioner.*')">
                                {{ __('Kelola Kusioner') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.tracer.index')" :active="request()->routeIs('admin.tracer.*')">
                                {{ __('Kelola Tracer') }}
                            </x-nav-link>
                        @else
                            {{-- === MENU USER === --}}
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('user.lokers.index')" :active="request()->routeIs('user.lokers.*')">
                                {{ __('Lowongan') }}
                            </x-nav-link>
                            <x-nav-link :href="route('user.alumni.index')" :active="request()->routeIs('user.alumni.*')">
                                {{ __('Network') }}
                            </x-nav-link>
                            <x-nav-link :href="route('user.events.index')" :active="request()->routeIs('user.events.*')">
                                {{ __('Events') }}
                            </x-nav-link>
                            <x-nav-link :href="route('user.tracer.index')" :active="request()->routeIs('user.tracer.*')">
                                {{ __('Tracer') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="text-right">
                                <div class="font-bold">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] text-blue-500 uppercase tracking-wider">
                                    Role: "{{ Auth::user()->role }}"
                                </div>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 text-xs text-gray-400 border-b border-gray-100">
                            @if(trim(strtolower(Auth::user()->role)) == 'admin')
                                <span class="text-green-600 font-bold">Administrator Aktif</span>
                            @else
                                <span class="text-gray-500">Mahasiswa / Alumni</span>
                            @endif
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (trim(strtolower(Auth::user()->role)) == 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard Admin') }}
                </x-responsive-nav-link>
                @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                @endif
        </div>
        </div>
</nav>