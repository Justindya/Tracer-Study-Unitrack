<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UniTrack') }}</title>

    {{-- Bootstrap (Wajib Ada) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0ea5e9',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    {{-- Fonts & Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        a { text-decoration: none; } 
        .navbar-brand { font-size: unset; }
        /* Animasi Halus */
        .animate-fade-in-up { animation: fadeInUp 0.5s ease-out; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        
        <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20"> <div class="flex items-center">
                        <div class="shrink-0 flex items-center mr-12"> <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                                <i class="fas fa-graduation-cap text-3xl text-purple-600 group-hover:scale-110 transition"></i>
                                <span class="text-2xl font-bold text-gray-900 tracking-tight">UniTrack</span>
                            </a>
                        </div>

                        <div class="hidden sm:-my-px sm:flex items-center space-x-8">
                            
                            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition-all duration-200 h-full flex items-center border-b-2 {{ request()->routeIs('dashboard') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent' }}">
                                Dashboard
                            </a>

                            <a href="{{ route('user.lokers.index') }}" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition-all duration-200 h-full flex items-center border-b-2 {{ request()->routeIs('user.lokers.*') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent' }}">
                                Lowongan
                            </a>

                            <a href="{{ route('user.alumni.index') }}" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition-all duration-200 h-full flex items-center border-b-2 {{ request()->routeIs('user.alumni.*') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent' }}">
                                Network
                            </a>

                            <a href="{{ route('user.events.index') }}" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition-all duration-200 h-full flex items-center border-b-2 {{ request()->routeIs('user.events.*') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent' }}">
                                Events
                            </a>
                            
                            <a href="{{ route('user.tracer.create') }}" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition-all duration-200 h-full flex items-center border-b-2 {{ request()->routeIs('user.tracer.*') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent' }}">
                                Tracer
                            </a>

                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                        
                        <button class="text-gray-400 hover:text-gray-600 relative">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                        </button>

                        <div class="h-8 w-px bg-gray-200 mx-2"></div> <div class="relative group">
                            <button class="flex items-center gap-3 focus:outline-none transition duration-150 ease-in-out">
                                <div class="text-right hidden md:block">
                                    <span class="block font-bold text-gray-800 text-sm leading-tight">{{ Auth::user()->name }}</span>
                                    <span class="block text-xs text-gray-400">Mahasiswa</span>
                                </div>
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border-2 border-white shadow-sm group-hover:shadow-md transition">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                            
                            <div class="absolute right-0 w-48 bg-white rounded-xl shadow-xl py-2 mt-2 hidden group-hover:block hover:block border border-gray-100 origin-top-right transition-all">
                                <div class="px-4 py-2 border-b border-gray-50">
                                    <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Akun Saya</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i class="fas fa-user-circle mr-2 w-5"></i> Edit Profil
                                </a>
                                <a href="{{ route('user.kusioner.index') }}" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i class="fas fa-clipboard-list mr-2 w-5"></i> Isi Kusioner
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>