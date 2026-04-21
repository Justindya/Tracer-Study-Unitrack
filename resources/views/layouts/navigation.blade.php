<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            {{--LOGO & MENU UTAMA --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ trim(strtolower(Auth::user()->role)) == 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" class="block h-9 w-auto fill-current text-gray-800" style="max-width: 90px;" />
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

            {{--PROFIL DROPDOWN --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6 relative" x-data="{ dropdownOpen: false }">
                
                {{-- TOMBOL TRIGGER --}}
                <button @click="dropdownOpen = !dropdownOpen" @click.outside="dropdownOpen = false" class="flex items-center gap-3 focus:outline-none cursor-pointer transition-transform hover:scale-[1.02]">
                    <div class="text-right hidden sm:block">
                        <div class="font-bold text-gray-900 text-sm leading-tight">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-gray-400 font-medium">
                            @if(trim(strtolower(Auth::user()->role)) == 'admin')
                                <span class="text-green-500 uppercase tracking-wider font-bold">Administrator</span>
                            @else
                                Mahasiswa / Alumni
                            @endif
                        </div>
                    </div>
                    
                    {{-- Avatar --}}
                    <div class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg shadow-sm">
                        @if(Auth::user()->alumni && Auth::user()->alumni->Foto)
                            <img src="{{ asset('storage/' . Auth::user()->alumni->Foto) }}" class="w-full h-full rounded-full object-cover">
                        @else
                            {{ substr(Auth::user()->name, 0, 1) }}
                        @endif
                    </div>
                </button>

                {{-- KOTAK MENU DROPDOWN --}}
                <div x-show="dropdownOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-[-10px]"
                     class="absolute right-0 top-[120%] z-50 w-56 rounded-2xl bg-white shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-gray-100 py-2"
                     style="display: none;">
                    
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-blue-600 hover:bg-blue-50 transition-colors">
                        <div class="w-6 text-center"><i class="fas fa-user-circle text-lg"></i></div>
                        Profil Saya
                    </a>

                    <div class="border-t border-gray-100 my-1"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-5 py-3 text-sm font-bold text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors text-left">
                            <div class="w-6 text-center"><i class="fas fa-sign-out-alt text-lg"></i></div>
                            Log Out
                        </button>
                    </form>
                </div>

            </div>

            {{-- MENU MOBILE  --}}
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

    {{-- KONTEN MENU MOBILE --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (trim(strtolower(Auth::user()->role)) == 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard Admin') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->requestIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>