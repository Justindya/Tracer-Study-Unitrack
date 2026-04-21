<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'UniTrack') }}</title>

    {{-- Bootstrap & Tailwind --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        a { text-decoration: none; } 

        input[type="text"], 
        input[type="search"], 
        select, 
        .search-container {
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            background-color: transparent !important;
        }

        .flex.items-center.border.rounded-xl {
            border: none !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        
        <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    
                    <div class="flex items-center">
                        <div class="shrink-0 flex items-center mr-12">
                            <a href="{{ trim(strtolower(Auth::user()->role)) == 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-2 group">
                                <i class="fas fa-graduation-cap text-3xl text-purple-600 group-hover:scale-110 transition"></i>
                                <span class="text-2xl font-bold text-gray-900 tracking-tight">UniTrack</span>
                            </a>
                        </div>

                        <div class="hidden sm:-my-px sm:flex items-center space-x-8">
                            
                            @if(trim(strtolower(Auth::user()->role)) == 'admin')
                                {{-- === MENU KHUSUS ADMIN === --}}
                                <a href="{{ route('admin.dashboard') }}" class="transition h-full flex items-center {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-bold' : 'text-gray-500 hover:text-blue-600 font-medium' }}">Dashboard</a>
                                <a href="{{ route('admin.alumni.index') }}" class="transition h-full flex items-center {{ request()->routeIs('admin.alumni.*') ? 'text-blue-600 font-bold' : 'text-gray-500 hover:text-blue-600 font-medium' }}">Kelola Alumni</a>
                                <a href="{{ route('admin.event.index') }}" class="transition h-full flex items-center {{ request()->routeIs('admin.event.*') ? 'text-blue-600 font-bold' : 'text-gray-500 hover:text-blue-600 font-medium' }}">Kelola Event</a>
                                <a href="{{ route('admin.loker.index') }}" class="transition h-full flex items-center {{ request()->routeIs('admin.loker.*') ? 'text-blue-600 font-bold' : 'text-gray-500 hover:text-blue-600 font-medium' }}">Kelola Loker</a>
                                <a href="{{ route('admin.tracer.index') }}" class="transition h-full flex items-center {{ request()->routeIs('admin.tracer.*') ? 'text-blue-600 font-bold' : 'text-gray-500 hover:text-blue-600 font-medium' }}">Data Tracer</a>
                            @else
                                {{-- === MENU KHUSUS USER === --}}
                                <a href="{{ route('dashboard') }}" class="transition h-full flex items-center {{ request()->routeIs('dashboard') ? 'text-blue-600 font-bold' : 'text-gray-500 hover:text-blue-600 font-medium' }}">Dashboard</a>
                                <a href="{{ route('user.lokers.index') }}" class="transition h-full flex items-center {{ request()->routeIs('user.lokers.*') ? 'text-blue-600 font-bold' : 'text-gray-500 hover:text-blue-600 font-medium' }}">Lowongan</a>
                                <a href="{{ route('user.alumni.index') }}" class="transition h-full flex items-center {{ (request()->routeIs('user.alumni.index') || request()->routeIs('user.alumni.show')) ? 'text-blue-600 font-bold' : 'text-gray-500 hover:text-blue-600 font-medium' }}">Network</a>
                                <a href="{{ route('user.events.index') }}" class="transition h-full flex items-center {{ request()->routeIs('user.events.*') ? 'text-blue-600 font-bold' : 'text-gray-500 hover:text-blue-600 font-medium' }}">Events</a>
                            @endif

                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                        <div class="relative group">
                            <button class="flex items-center gap-3 focus:outline-none transition duration-150 ease-in-out">
                                <div class="text-right hidden md:block">
                                    <span class="block font-bold text-gray-800 text-sm leading-tight">{{ Auth::user()->name }}</span>
                                    <span class="block text-xs text-gray-400">
                                        {{ trim(strtolower(Auth::user()->role)) == 'admin' ? 'Administrator' : 'Mahasiswa / Alumni' }}
                                    </span>
                                </div>
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border-2 border-white shadow-sm group-hover:shadow-md transition">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                            
                            <div class="absolute right-0 w-48 bg-white rounded-xl shadow-xl py-2 mt-2 hidden group-hover:block hover:block border border-gray-100 origin-top-right z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm {{ request()->routeIs('profile.*') || request()->routeIs('user.alumni.edit') ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }} transition">
                                    <i class="fas fa-user-circle mr-2 w-5"></i> Profil Saya
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition rounded-b-xl">
                                        <i class="fas fa-sign-out-alt mr-2 w-5"></i> Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </nav>

        <main>
            @if (isset($slot))
                {{ $slot }}
            @else
                <div class="py-6">
                    @yield('content')
                </div>
            @endif
        </main>
    </div>
</body>
</html>