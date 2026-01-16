<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login - Tracer Study</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8 relative">
        <a href="/" class="absolute top-6 left-6 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times text-xl"></i>
        </a>

        <div class="text-center mb-8">
            <div class="flex justify-center items-center space-x-2 mb-2">
                <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                <span class="text-2xl font-bold text-gray-800">UniTrack</span>
            </div>
            <p class="text-gray-500 text-sm">Login Menggunakan NIM</p>
        </div>

        @if(session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
                <input type="text" name="nim" :value="old('nim')" placeholder="Masukkan NIM Anda" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" required autofocus autocomplete="username">
                @error('nim') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" required autocomplete="current-password">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center mb-6">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">Ingat Saya</label>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md transform hover:scale-[1.02]">
                MASUK SEKARANG
            </button>
        </form>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar di sini</a></p>
        </div>
    </div>

</body>
</html>