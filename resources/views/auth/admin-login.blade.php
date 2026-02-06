<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Portal - UniTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl m-4">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Admin Portal</h1>
            <p class="text-sm text-gray-500">Silakan login untuk mengelola sistem.</p>
        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Email Administrator</label>
                <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" placeholder="admin@unitrack.com" required autofocus>
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white font-bold py-3 rounded-lg transition duration-300 shadow-lg transform hover:-translate-y-0.5">
                MASUK KE DASHBOARD
            </button>
        </form>

        <div class="mt-6 text-center border-t border-gray-100 pt-4">
            <a href="/" class="text-xs text-gray-400 hover:text-gray-600 transition">← Kembali ke Halaman Utama</a>
        </div>
    </div>

</body>
</html>