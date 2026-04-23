<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Study - Universitas Sugeng Hartono</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo-ush.png') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                    }
                }
            }
        }
    </script>
    
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-ush-light flex items-center justify-center min-h-screen p-4">

    <div class="bg-white w-full max-w-md rounded-[2rem] shadow-xl p-8 relative border border-slate-100">
        
        <a href="/" class="absolute top-6 left-6 text-slate-400 hover:text-ush-blue transition"><i class="fas fa-arrow-left text-xl"></i></a>

        <div class="text-center mb-10 mt-4">
            <div class="flex justify-center items-center gap-3 mb-4">
                <img src="{{ asset('images/logo-ush.png') }}" alt="Logo USH" class="h-14 w-auto">
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Portal Tracer Study</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Universitas Sugeng Hartono</p>
        </div>

        @if(session('status'))
            <div class="mb-6 text-xs font-bold text-green-700 bg-green-50 p-4 rounded-xl border border-green-200 text-center">
                <i class="fas fa-check-circle mr-1"></i> {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <div>
                <label class="text-[11px] font-bold text-slate-600 mb-1.5 block uppercase tracking-widest">NIM / ID Pengguna</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i class="far fa-id-card"></i>
                    </span>
                    <input type="text" name="nim" value="{{ old('nim') }}" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:border-ush-blue focus:ring-2 focus:ring-ush-blue/20 outline-none transition bg-slate-50 focus:bg-white font-medium text-sm text-slate-800" placeholder="Masukkan NIM Anda" required autofocus>
                </div>
                @error('nim') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-[11px] font-bold text-slate-600 mb-1.5 block uppercase tracking-widest">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:border-ush-blue focus:ring-2 focus:ring-ush-blue/20 outline-none transition bg-slate-50 focus:bg-white font-medium text-sm text-slate-800" placeholder="••••••••" required>
                </div>
                @error('password') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between pt-2">
                <label class="flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-ush-blue border-slate-300 rounded focus:ring-ush-blue cursor-pointer">
                    <span class="ml-2 text-xs text-slate-500 font-semibold group-hover:text-ush-blue transition">Ingat Saya</span>
                </label>
                
                {{-- Lupa Password diarahkan ke WhatsApp Admin --}}
                <a href="https://wa.me/628982188488?text=Halo%20Admin%20CDC%20USH,%20saya%20lupa%20kata%20sandi%20portal%20Tracer%20Study%20dan%20membutuhkan%20bantuan%20reset." target="_blank" class="text-xs text-ush-blue hover:text-ush-gold font-bold hover:underline transition">
                    Lupa Kata Sandi?
                </a>
            </div>

            <button type="submit" class="w-full bg-ush-blue hover:bg-slate-900 text-white font-bold py-4 rounded-xl transition duration-300 shadow-lg shadow-ush-blue/30 transform hover:-translate-y-0.5 flex justify-center items-center gap-2 text-sm mt-4">
                MASUK PORTAL <i class="fas fa-sign-in-alt text-xs"></i>
            </button>
        </form>

        <div class="text-center mt-10 pt-6 border-t border-slate-100">
            <p class="text-[11px] text-slate-400 font-medium">Akun otomatis terdaftar untuk alumni.<br>Hubungi <a href="https://wa.me/6281234567890" target="_blank" class="font-bold text-slate-600 hover:text-ush-blue transition">Admin CDC</a> jika data Anda tidak ditemukan.</p>
        </div>
    </div>

</body>
</html>