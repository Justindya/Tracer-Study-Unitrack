<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar - Tracer Study</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4 py-10">

    <div class="bg-white w-full max-w-4xl rounded-2xl shadow-xl p-8 relative">
        <a href="/" class="absolute top-6 left-6 text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></a>

        <div class="text-center mb-8">
            <div class="flex justify-center items-center space-x-2 mb-2">
                <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                <span class="text-2xl font-bold text-gray-800">UniTrack</span>
            </div>
            <p class="text-gray-500 text-sm">Lengkapi Data Diri Alumni</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div class="col-span-2 md:col-span-1">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" :value="old('name')" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none" required autofocus autocomplete="name">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" :value="old('email')" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none" required autocomplete="username">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
                <input type="text" name="nim" :value="old('nim')" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none" required autocomplete="nim">
                @error('nim') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">No HP</label>
                <input type="number" name="no_hp" :value="old('no_hp')" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none" required>
                @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Angkatan</label>
                <input type="text" name="angkatan" :value="old('angkatan')" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none" required>
                @error('angkatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Tahun Lulus</label>
                <input type="text" name="tahun_lulus" :value="old('tahun_lulus')" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none" required>
                @error('tahun_lulus') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Program Studi</label>
                <select name="program_studi" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none bg-white" required>
                    <option value="">-- Pilih Program Studi --</option>
                    <option value="DIII - Akutansi">DIII - Akutansi</option>
                    <option value="DIII - Teknik Mesin">DIII - Teknik Mesin</option>
                    <option value="DIII - Teknik Komputer">DIII - Teknik Komputer</option>
                    <option value="DIII - Teknik Elerektronika">DIII - Teknik Elerektronika</option>
                    <option value="DIII - Mekanik Otomotif">DIII - Mekanik Otomotif</option>
                    <option value="DIII - Alat Berat">DIII - Alat Berat</option>
                    <option value="DIII - Teknik Kimia">DIII - Teknik Kimia(industri)</option>
                    <option value="DIII - Rekam Medik & Informasi Kesehatan">DIII - Rekam Medik & Informasi Kesehatan</option>
                    <option value="DIV - Teknik Informatika">DIV - Teknik Informatika</option>
                    <option value="DIV - Mekanik Industri Dan Desain">DIV - Mekanik Industri Dan Desain</option>
                    <option value="DIV - Mekatronika">DIV - Mekatronika</option>
                    <option value="DIV - Komputer Akutansi">DIV - Komputer Akutansi</option>
                    <option value="DIV - Teknik Otomasi">DIV - Teknik Otomasi</option>
                    <option value="DIV - Kontruksi Bangunan">DIV - Kontruksi Bangunan</option>
                </select>
                @error('program_studi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                <input type="text" name="alamat" :value="old('alamat')" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none" required>
                @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none bg-white" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                @error('jenis_kelamin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password (Angka)</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none" required autocomplete="new-password" pattern="\d*" title="Password harus berupa angka">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none" required autocomplete="new-password" pattern="\d*" title="Password harus berupa angka">
                @error('password_confirmation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="col-span-2 mt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md transform hover:scale-[1.01]">
                    DAFTAR SEKARANG
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Login Sekarang</a></p>
        </div>
    </div>
</body>
</html>