<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniTrack - Tracer Alumni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="antialiased text-gray-800 bg-white">

    <nav class="bg-white py-4 shadow-sm fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                <span class="text-2xl font-bold text-gray-900">UniTrack</span>
            </div>

            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-600">
                <a href="#" class="hover:text-purple-600 transition">Home</a>
                <a href="#fitur" class="hover:text-purple-600 transition">Fitur</a>
                <a href="#kontak" class="hover:text-purple-600 transition">Kontak</a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="<?php echo e(route('login')); ?>" class="text-gray-600 hover:text-purple-600 font-medium transition">
                    Masuk
                </a>
                <a href="<?php echo e(route('register')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition shadow-md">
                    Daftar
                </a>
            </div>
        </div>
    </nav>

    <header class="relative h-screen flex items-center justify-center text-center px-4 mt-16 bg-gray-900">
        <div class="absolute inset-0 z-0 opacity-60" style="background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1986'); background-size: cover; background-position: center;"></div>
        
        <div class="relative z-10 max-w-4xl text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di UniTrack</h1>
            <p class="text-lg md:text-xl mb-8 font-light text-gray-200">Platform Tracking Alumni & Job Board untuk Mahasiswa dan Alumni</p>
            <a href="<?php echo e(route('register')); ?>" class="bg-white text-blue-600 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition shadow-lg">
                Mulai Sekarang
            </a>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-500 rounded-2xl p-8 text-center text-white shadow-xl transform hover:-translate-y-2 transition">
                <i class="fas fa-users text-4xl mb-4"></i>
                <h3 class="text-3xl font-bold">2,500+</h3>
                <p class="text-blue-100">Alumni Terdaftar</p>
            </div>
            <div class="bg-blue-500 rounded-2xl p-8 text-center text-white shadow-xl transform hover:-translate-y-2 transition">
                <i class="fas fa-briefcase text-4xl mb-4"></i>
                <h3 class="text-3xl font-bold">150+</h3>
                <p class="text-blue-100">Lowongan Pekerjaan</p>
            </div>
            <div class="bg-blue-500 rounded-2xl p-8 text-center text-white shadow-xl transform hover:-translate-y-2 transition">
                <i class="fas fa-calendar-alt text-4xl mb-4"></i>
                <h3 class="text-3xl font-bold">20+</h3>
                <p class="text-blue-100">Event</p>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-24">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-16 text-gray-800">Fitur UniTrack</h2>
            
            <div class="flex flex-col md:flex-row items-center justify-center gap-12">
                <div class="w-full md:w-1/3">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500&auto=format&fit=crop" alt="Team" class="rounded-xl shadow-lg transform -rotate-3">
                </div>
                
                <div class="w-full md:w-1/3 text-left text-gray-600 leading-relaxed px-4">
                    <p class="mb-4">UniTrack hadir untuk menjaga sinergi antara alumni dan kampus. Mari saling terhubung, berbagi inspirasi, dan membangun jaringan profesional yang lebih kuat.</p>
                    <p>Update status karir Anda sekarang dan jadilah bagian dari peta kesuksesan komunitas alumni kami.</p>
                </div>

                <div class="w-full md:w-1/3">
                    <a href="<?php echo e(route('register')); ?>" class="block bg-blue-500 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden group cursor-pointer hover:bg-blue-600 transition">
                        <div class="absolute top-0 right-0 p-4 opacity-20 group-hover:scale-110 transition">
                            <i class="fas fa-search text-6xl"></i>
                        </div>
                        <i class="fas fa-users text-4xl mb-4"></i>
                        <h3 class="text-xl font-bold">Tracer Alumni</h3>
                        <p class="text-xs text-blue-100 mt-2">Isi data alumni sekarang</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue-600 py-20 text-center text-white">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6">Siap Memulai Perjalanan Karir Anda?</h2>
            <p class="text-lg text-blue-100 mb-8">Bergabung dengan UniTrack sekarang dan temukan peluang tanpa batas untuk masa depan Anda.</p>
            <a href="<?php echo e(route('register')); ?>" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold shadow-lg hover:bg-gray-100 transition">
                Daftar Sekarang
            </a>
        </div>
    </section>

    <footer id="kontak" class="bg-gray-900 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-white text-2xl font-bold mb-4 flex items-center gap-2">
                    <i class="fas fa-graduation-cap text-purple-500"></i> UniTrack
                </h3>
                <p class="text-sm leading-relaxed">Platform tracer alumni dan job board terintegrasi untuk mendukung karir mahasiswa dan alumni.</p>
            </div>
            
            <div>
                <h4 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Home</a></li>
                    <li><a href="#fitur" class="hover:text-white transition">Fitur</a></li>
                    <li><a href="#kontak" class="hover:text-white transition">Kontak</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Hubungi Kami</h4>
                <ul class="space-y-2 text-sm">
                    <li><i class="fas fa-envelope mr-2"></i> info@unitrack.ac.id</li>
                    <li><i class="fas fa-phone mr-2"></i> (021) 1234-5678</li>
                    <li><i class="fas fa-map-marker-alt mr-2"></i> Kampus Utama</li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="#" class="bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        
        <div class="text-center text-xs mt-12 border-t border-gray-800 pt-8">
            &copy; 2026 UniTrack. All rights reserved.
        </div>
    </footer>
</body>
</html><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/welcome.blade.php ENDPATH**/ ?>