<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Study - Universitas Sugeng Hartono</title>
    <link rel="icon" href="{{ asset('images/logo-ush.png') }}" type="image/png">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        ush: {
                            blue: '#0F2C59',
                            gold: '#F59E0B', 
                            light: '#F8FAFC'
                        }
                    },
                    boxShadow: {
                        'halus': '0 10px 40px -10px rgba(0,0,0,0.04)',
                    },
                    animation: {
                        'float': 'float 4s ease-in-out infinite',
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .bg-pastel-gradient {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, hsla(213,80%,89%,0.7) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(43,100%,89%,0.7) 0, transparent 50%);
        }

        input[type="text"], input[type="search"], select, .search-container {
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            background-color: transparent !important;
        }
        .flex.items-center.border.rounded-xl { border: none !important; box-shadow: none !important; }
    </style>
</head>
<body class="antialiased bg-white text-slate-800">

    {{-- NAVBAR --}}
    <nav x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="scrolled ? 'bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm py-4' : 'bg-transparent py-6'"
         class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            
            {{-- Brand Ala UPI --}}
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-ush.png') }}" alt="Logo USH" class="h-10 w-auto drop-shadow-sm">
                <div class="flex flex-col justify-center">
                    <span class="text-[15px] font-extrabold text-ush-blue leading-tight tracking-tight uppercase">Universitas</span>
                    <span class="text-[15px] font-extrabold text-ush-blue leading-tight tracking-tight uppercase">Sugeng Hartono</span>
                </div>
                <div class="border-l border-slate-300 h-8 mx-2"></div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-slate-800 leading-tight">Tracer</span>
                    <span class="text-sm font-bold text-slate-800 leading-tight">Study</span>
                </div>
            </div>

            {{-- Navigasi --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-sm font-medium text-slate-500 hover:text-ush-blue transition">Beranda</a>
                <a href="#tentang" class="text-sm font-medium text-slate-500 hover:text-ush-blue transition">Tentang</a>
                <a href="#layanan" class="text-sm font-medium text-slate-500 hover:text-ush-blue transition">Layanan</a>
                
                {{-- Login Button --}}
                <a href="{{ route('login') }}" class="px-6 py-2.5 bg-slate-900 text-white rounded-full font-semibold text-sm hover:bg-slate-800 transition-all flex items-center gap-2 shadow-sm ml-4">
                    Login <i class="fas fa-chevron-down text-[10px]"></i>
                </a>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION (Background Transparan Penuh) --}}
    <header class="relative pt-40 pb-32 bg-pastel-gradient flex items-center justify-center min-h-[90vh] overflow-hidden">
        {{-- Watermark Gedung Transparan Full --}}
        <div class="absolute inset-0 opacity-10 mix-blend-multiply flex items-center justify-center pointer-events-none">
             <img src="{{ asset('images/hero-bg.jpg') }}" alt="Background Gedung" class="w-full h-full object-cover">
        </div>

        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-slate-900 leading-[1.1] mb-8 tracking-tight">
                Selamat Datang <br> 
                Di Website <span class="text-ush-gold">Tracer Study</span> <br>
                <span class="text-ush-blue">Universitas Sugeng Hartono</span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-600 mb-10 max-w-2xl mx-auto font-medium leading-relaxed">
                Wadah resmi untuk menghubungkan lulusan, membangun relasi, dan memetakan peluang karir terbaik.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#panduan" class="w-full sm:w-auto px-8 py-3.5 bg-white text-slate-700 border border-slate-300 rounded-full font-bold text-sm hover:bg-slate-50 transition shadow-sm">
                    Panduan Pengisian
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-3.5 bg-ush-blue text-white rounded-full font-extrabold text-sm shadow-lg shadow-ush-blue/20 hover:bg-slate-800 transition-transform transform hover:-translate-y-0.5">
                    Isi Survey
                </a>
            </div>
        </div>
    </header>

    {{-- TENTANG TRACER STUDY --}}
    <section id="tentang" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6">
                        Apa itu <span class="text-ush-blue">Tracer Study</span>?
                    </h2>
                    <p class="text-slate-600 leading-relaxed text-lg mb-6">
                        Tracer Study merupakan metode yang digunakan oleh institusi pendidikan untuk memperoleh umpan balik dari alumni. Data ini sangat dibutuhkan oleh universitas dalam usahanya melakukan perbaikan serta pengembangan kualitas sistem pendidikan.
                    </p>
                    <p class="text-slate-600 leading-relaxed text-lg">
                        Umpan balik ini bermanfaat untuk memetakan dunia usaha dan industri agar jeda antara kompetensi yang diperoleh alumni saat kuliah dengan tuntutan dunia kerja dapat diperkecil.
                    </p>
                </div>

                {{-- Gambar Animasi Float --}}
                <div class="w-full lg:w-1/2 flex justify-center">
                    <img src="{{ asset('images/canva.png') }}" alt="Ilustrasi Tracer" class="max-w-md w-full h-auto rounded-2xl shadow-halus border-slate-100">
                </div>

            </div>
        </div>
    </section>

    {{-- PANDUAN PENGISIAN --}}
    <section id="panduan" class="py-24 bg-ush-blue text-white overflow-hidden relative" 
             x-data="{ activeStep: 1 }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Panduan Pengisian</h2>
                <p class="text-blue-100/80 font-medium">Panduan pengisian lebih lengkap dapat diunduh <a href="{{ asset('guidelines.pdf') }}" target="_blank" class="underline decoration-2 hover:text-white">di sini.</a></p>
            </div>

            <div class="flex flex-col lg:flex-row items-stretch gap-12 lg:gap-20">
                
                {{-- Kiri: Langkah --}}
                <div class="w-full lg:w-1/2 space-y-4 flex flex-col justify-between">
                    
                    <div @click="activeStep = 1" class="p-6 rounded-2xl cursor-pointer transition duration-300" :class="activeStep === 1 ? 'bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg' : 'hover:bg-white/5'">
                        <h3 class="text-xl font-bold mb-2">Klik Isi Survey</h3>
                        <p class="text-blue-100/80 text-sm">Pada halaman utama, klik tombol Isi Survey yang tersedia.</p>
                    </div>

                    <div @click="activeStep = 2" class="p-6 rounded-2xl cursor-pointer transition duration-300" :class="activeStep === 2 ? 'bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg' : 'hover:bg-white/5'">
                        <h3 class="text-xl font-bold mb-2">Cek Akun</h3>
                        <p class="text-blue-100/80 text-sm">Akses masuk sistem dengan cara login menggunakan Nomor Induk Mahasiswa (NIM) Anda.</p>
                    </div>

                    <div @click="activeStep = 3" class="p-6 rounded-2xl cursor-pointer transition duration-300" :class="activeStep === 3 ? 'bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg' : 'hover:bg-white/5'">
                        <h3 class="text-xl font-bold mb-2">Isi Semua Instrumen</h3>
                        <p class="text-blue-100/80 text-sm">Lengkapi semua isian instrumen kuesioner, pastikan data dimasukkan akurat dan lengkap.</p>
                    </div>

                    <div @click="activeStep = 4" class="p-6 rounded-2xl cursor-pointer transition duration-300" :class="activeStep === 4 ? 'bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg' : 'hover:bg-white/5'">
                        <h3 class="text-xl font-bold mb-2">Selesai</h3>
                        <p class="text-blue-100/80 text-sm">Klik submit untuk menyelesaikannya. Terimakasih telah ikut berpartisipasi.</p>
                    </div>

                </div>

                {{-- Kanan --}}
                <div class="w-full lg:w-1/2 flex items-stretch">
                    <div class="bg-white rounded-xl shadow-2xl transform lg:translate-x-8 overflow-hidden w-full flex flex-col">
                        <div class="flex gap-2 mb-0 px-4 py-3 bg-slate-50 border-b border-slate-100">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        
                        <div class="relative w-full flex-grow bg-slate-100 flex items-center justify-center">
                            <template x-if="activeStep === 1">
                                <img src="{{ asset('images/ush-satu.jpg') }}" alt="Panduan 1" class="absolute inset-0 w-full h-full object-cover animate-fade-in">
                            </template>
                            <template x-if="activeStep === 2">
                                <img src="{{ asset('images/aset satu.png') }}" alt="Panduan 2" class="absolute inset-0 w-full h-full object-cover animate-fade-in">
                            </template>
                            <template x-if="activeStep === 3">
                                <img src="{{ asset('images/aset dua.png') }}" alt="Panduan 3" class="absolute inset-0 w-full h-full object-cover animate-fade-in">
                            </template>
                            <template x-if="activeStep === 4">
                                <img src="{{ asset('images/fasilitas-dua.png') }}" alt="Panduan 4" class="absolute inset-0 w-full h-full object-cover animate-fade-in">
                            </template>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- LAYANAN UTAMA --}}
    <section id="layanan" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Layanan Utama</h2>
                <p class="text-slate-500">Temukan informasi terkini dan fasilitas eksklusif alumni di sini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Loker --}}
                <div class="bg-white rounded-2xl p-8 shadow-halus border border-slate-100 hover:border-ush-blue transition duration-300 flex flex-col h-full group cursor-pointer">
                    <div class="w-12 h-12 bg-blue-50 text-ush-blue rounded-full flex items-center justify-center mb-6 text-xl">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-ush-blue transition mb-2 uppercase tracking-wide">Bursa Kerja</h3>
                    <p class="text-sm text-slate-500 mb-6 flex-grow">Berbagai lowongan magang dan full-time dari mitra industri kampus.</p>
                    <a href="{{ route('login') }}" class="text-ush-blue text-sm font-semibold flex items-center gap-1 group-hover:underline decoration-2 underline-offset-4">
                        Buka Lowongan <i class="fas fa-arrow-right text-[10px] ml-1"></i>
                    </a>
                </div>

                {{-- Jejaring --}}
                <div class="bg-white rounded-2xl p-8 shadow-halus border border-slate-100 hover:border-ush-blue transition duration-300 flex flex-col h-full group cursor-pointer">
                    <div class="w-12 h-12 bg-blue-50 text-ush-blue rounded-full flex items-center justify-center mb-6 text-xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-ush-blue transition mb-2 uppercase tracking-wide">Jejaring Alumni</h3>
                    <p class="text-sm text-slate-500 mb-6 flex-grow">Temukan teman seangkatan dan bangun relasi lintas fakultas.</p>
                    <a href="{{ route('login') }}" class="text-ush-blue text-sm font-semibold flex items-center gap-1 group-hover:underline decoration-2 underline-offset-4">
                        Cari Relasi <i class="fas fa-arrow-right text-[10px] ml-1"></i>
                    </a>
                </div>

                {{-- Event --}}
                <div class="bg-white rounded-2xl p-8 shadow-halus border border-slate-100 hover:border-ush-blue transition duration-300 flex flex-col h-full group cursor-pointer">
                    <div class="w-12 h-12 bg-blue-50 text-ush-blue rounded-full flex items-center justify-center mb-6 text-xl">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-ush-blue transition mb-2 uppercase tracking-wide">Event Kampus</h3>
                    <p class="text-sm text-slate-500 mb-6 flex-grow">Pendaftaran job fair dan seminar karir dalam satu sentuhan.</p>
                    <a href="{{ route('login') }}" class="text-ush-blue text-sm font-semibold flex items-center gap-1 group-hover:underline decoration-2 underline-offset-4">
                        Daftar Event <i class="fas fa-arrow-right text-[10px] ml-1"></i>
                    </a>
                </div>

                {{-- CV Generator --}}
                <div class="bg-white rounded-2xl p-8 shadow-halus border border-slate-100 hover:border-ush-blue transition duration-300 flex flex-col h-full group cursor-pointer">
                    <div class="w-12 h-12 bg-blue-50 text-ush-blue rounded-full flex items-center justify-center mb-6 text-xl">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-ush-blue transition mb-2 uppercase tracking-wide">CV Generator ATS</h3>
                    <p class="text-sm text-slate-500 mb-6 flex-grow">Buat CV profesional ramah ATS otomatis dari data profil Anda.</p>
                    <a href="{{ route('login') }}" class="text-ush-blue text-sm font-semibold flex items-center gap-1 group-hover:underline decoration-2 underline-offset-4">
                        Buat CV <i class="fas fa-arrow-right text-[10px] ml-1"></i>
                    </a>
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="{{ route('dashboard') }}" class="inline-block px-8 py-2.5 bg-slate-100 text-slate-600 font-bold text-sm rounded-full hover:bg-slate-200 transition">
                    Tampilkan Semua di Dashboard
                </a>
            </div>
        </div>
    </section>

    {{-- CTA (Rata Kiri ala UPI) --}}
    <section class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight text-left">
                    Mari sukseskan pelaksanaan <br><span class="text-ush-blue">Tracer Study</span> Universitas Sugeng Hartono
                </h2>
                
                <a href="{{ route('login') }}" class="px-10 py-3.5 bg-ush-blue text-white rounded-full font-bold hover:bg-slate-800 transition shadow-lg shadow-ush-blue/20 whitespace-nowrap">
                    Isi Survey
                </a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-ush-blue pt-16 pb-8 border-t border-ush-blue">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            
            {{-- Info Kampus --}}
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <img src="{{ asset('images/logo-ush.png') }}" alt="Logo" class="h-12 w-auto">
                    <div class="flex flex-col">
                        <span class="text-white font-extrabold text-xl leading-none">USH</span>
                        <span class="text-blue-100/80 font-bold text-sm leading-none">TRACER<br>STUDY</span>
                    </div>
                </div>
                <h4 class="font-bold text-white mb-2">CDC USH</h4>
                <p class="text-sm text-blue-100/70 leading-relaxed font-medium">
                    Universitas Sugeng Hartono<br>
                    Jl. Ir. Soekarno No. 69, Solo Baru, Sukoharjo, Central Java<br>
                    Indonesia<br>
                    57552
                </p>
            </div>
            
            {{-- Kontak --}}
            <div>
                <h4 class="text-white font-bold mb-6">Kontak Kami</h4>
                <ul class="space-y-4 text-sm text-blue-100/70 font-medium">
                    <li>+62 898-2188-488</li>
                    <li>ush@sugenghartono.ac.id</li>
                </ul>
            </div>

            {{-- Tautan --}}
            <div>
                <h4 class="text-white font-bold mb-6">Tautan Penting</h4>
                <ul class="space-y-4 text-sm text-blue-100/70 font-medium">
                    <li><a href="{{ route('login') }}" class="hover:text-ush-gold transition">Isi Survey</a></li>
                    <li><a href="#" class="hover:text-ush-gold transition">CDC USH</a></li>
                    <li><a href="#" class="hover:text-ush-gold transition">Universitas Sugeng Hartono</a></li>
                </ul>
            </div>
            
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 text-center text-xs text-blue-100/50 font-medium flex justify-between pt-8 border-t border-white/10">
            <p>&copy; {{ date('Y') }} Universitas Sugeng Hartono.</p>
            <p>Designed by UniTrack Team</p>
        </div>
    </footer>

</body>
</html>