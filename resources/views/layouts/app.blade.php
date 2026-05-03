<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tracer Study - Universitas Sugeng Hartono</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-ush.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        ush: {
                            blue: '#0F2C59',
                            gold: '#F59E0B'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        a { text-decoration: none; } 
        .form-control {
            border: 1px solid #ced4da !important;
            border-radius: 0.5rem !important;
            background-color: #fff !important;
        }
        .form-control:focus {
            border-color: #0F2C59 !important;
            box-shadow: 0 0 0 0.25rem rgba(15, 44, 89, 0.1) !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800">
    <div class="min-h-screen flex flex-col">
        
        <nav class="bg-white border-b border-slate-100 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    
                    <div class="flex items-center">
                        <div class="shrink-0 flex items-center mr-12">
                            <a href="{{ trim(strtolower(Auth::user()->role)) == 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-3 group">
                                <img src="{{ asset('images/logo-ush.png') }}" alt="Logo USH" class="h-10 w-auto group-hover:scale-105 transition-transform duration-300">
                                <div class="flex flex-col">
                                    <span class="text-xl font-bold text-ush-blue leading-tight tracking-tight">UniTrack</span>
                                </div>
                            </a>
                        </div>

                        <div class="hidden sm:flex items-center space-x-2">
                            @if(trim(strtolower(Auth::user()->role)) == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-ush-blue font-bold' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Dashboard</a>
                                <a href="{{ route('admin.mahasiswa.index') }}" class="px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.mahasiswa.*') ? 'text-ush-blue font-bold' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Kelola Mahasiswa</a>
                                <a href="{{ route('admin.alumni.index') }}" class="px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.alumni.*') ? 'text-ush-blue font-bold' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Kelola Alumni</a>
                                <a href="{{ route('admin.event.index') }}" class="px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.event.*') ? 'text-ush-blue font-bold' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Kelola Event</a>
                                <a href="{{ route('admin.loker.index') }}" class="px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.loker.*') ? 'text-ush-blue font-bold' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Kelola Loker</a>
                                <a href="{{ route('admin.tracer.index') }}" class="px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.tracer.*') ? 'text-ush-blue font-bold' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Data Tracer</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'text-ush-blue font-bold ' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Dashboard</a>
                                <a href="{{ route('user.lokers.index') }}" class="px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('user.lokers.*') ? 'text-ush-blue font-bold' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Lowongan</a>
                                <a href="{{ route('user.alumni.index') }}" class="px-4 py-2 rounded-lg transition-colors {{ (request()->routeIs('user.alumni.index') || request()->routeIs('user.alumni.show')) ? 'text-ush-blue font-bold' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Network</a>
                                <a href="{{ route('user.events.index') }}" class="px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('user.events.*') ? 'text-ush-blue font-bold' : 'text-slate-500 hover:text-ush-blue font-medium' }}">Events</a>
                            @endif
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                        <div class="relative group" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" @click.outside="dropdownOpen = false" class="flex items-center gap-3 focus:outline-none">
                                <div class="text-right hidden md:block">
                                    <span class="block font-bold text-slate-900 text-sm leading-tight">{{ Auth::user()->name }}</span>
                                    <span class="block text-[11px] text-slate-500 font-medium">
                                        {{ Auth::user()->isAdmin() ? 'Administrator' : (Auth::user()->isAlumni() ? 'Alumni' : 'Mahasiswa') }}
                                    </span>
                                </div>
                                <div class="h-10 w-10 rounded-full bg-blue-50 text-ush-blue font-bold border border-blue-100 flex items-center justify-center transition group-hover:bg-ush-blue group-hover:text-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                            
                            <div x-show="dropdownOpen" class="absolute right-0 w-48 bg-white rounded-xl shadow-lg py-2 mt-2 border border-slate-100 z-50 origin-top-right" style="display: none;">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-ush-blue transition">
                                    <i class="fas fa-user-circle mr-2 w-5"></i> Profil Saya
                                </a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                                        <i class="fas fa-sign-out-alt mr-2 w-5"></i> Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </nav>

        <main class="flex-grow pb-8 pt-6"> 
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>