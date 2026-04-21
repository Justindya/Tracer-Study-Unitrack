<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <div class="py-8 bg-gray-50 min-h-screen font-sans">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row gap-6">
                
                {{-- SIDEBAR KIRI --}}
                <div class="w-full md:w-1/3">
                    <div class="bg-white p-5 rounded-2xl shadow-sm text-center sticky top-24 border border-gray-100">
                        <div class="w-24 h-24 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 text-white text-3xl font-bold border-4 border-blue-100 shadow-sm overflow-hidden">
                            @if(Auth::user()->alumni && Auth::user()->alumni->Foto)
                                <img src="{{ asset('storage/' . Auth::user()->alumni->Foto) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($user->name, 0, 1) }}
                            @endif
                        </div>
                        
                        <h2 class="text-lg font-bold text-gray-900 break-words">{{ $user->name }}</h2>
                        <p class="text-gray-500 text-xs mb-5">{{ $user->email }}</p>

                        <nav class="mt-4 text-left space-y-1">
                            <button onclick="switchTab('info', this)" class="tab-btn w-full flex items-center px-3 py-2 text-blue-600 font-bold text-xs bg-blue-50 rounded-lg transition">
                                <i class="fas fa-user-cog w-5 text-center"></i> Akun Login
                            </button>
                            <a href="{{ route('user.alumni.edit', Auth::user()->alumni->id ?? 0) }}" class="w-full flex items-center px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg text-xs transition">
                                <i class="fas fa-id-card w-5 text-center"></i> Biodata & Bio
                            </a>
                            <button onclick="switchTab('password', this)" class="tab-btn w-full flex items-center px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg text-xs transition">
                                <i class="fas fa-lock w-5 text-center"></i> Ganti Password
                            </button>
                            <div class="mt-2 pt-2 border-t">
                                <button onclick="switchTab('delete', this)" class="tab-btn w-full flex items-center px-3 py-2 text-red-500 hover:bg-red-50 rounded-lg text-xs transition">
                                    <i class="fas fa-trash-alt w-5 text-center"></i> Hapus Akun
                                </button>
                            </div>
                        </nav>
                    </div>
                </div>

                {{-- KONTEN KANAN --}}
                <div class="w-full md:w-2/3 space-y-5">
                    
                    {{-- PENGATURAN AKUN --}}
                    <div id="info" class="tab-content block">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                            <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-100">
                                <h3 class="text-2xl font-bold text-gray-900">Pengaturan Akun</h3>
                                
                                @if (session('status') === 'profile-updated')
                                    <span id="toast-success" class="text-xs text-green-700 font-bold bg-green-50 px-3 py-1.5 rounded-lg border border-green-200 transition-opacity duration-500 opacity-100">
                                        <i class="fas fa-check-circle mr-1"></i> Tersimpan
                                    </span>
                                @endif
                            </div>
                            
                            <form method="post" action="{{ route('profile.update') }}">
                                @csrf
                                @method('patch')

                                <div class="grid grid-cols-1 gap-4 mb-4 max-w-lg">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Nama Akun</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm font-medium" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Email Login</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm font-medium" required>
                                    </div>
                                </div>

                                {{-- UI/UX  --}}
                                <div class="flex items-center justify-end mt-2">
                                    <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>

                            {{-- Lengkapi Profil --}}
                            @if(Auth::user()->alumni)
                            <div class="mt-8 bg-indigo-50/70 border border-indigo-100 rounded-xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-lg flex-shrink-0">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-sm">Lengkapi Profil Publik?</h4>
                                        <p class="text-xs text-gray-500 mt-0.5">Bio, Foto, LinkedIn, dll.</p>
                                    </div>
                                </div>
                                <a href="{{ route('user.alumni.edit', Auth::user()->alumni->id) }}" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2.5 bg-white border-2 border-indigo-200 text-indigo-700 text-sm font-bold rounded-lg hover:border-indigo-600 hover:text-indigo-800 transition">
                                    Edit Biodata <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- GANTI PASSWORD --}}
                    <div id="password" class="tab-content hidden">
                        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-100">Ganti Password</h3>
                            
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="space-y-4 mb-4 max-w-lg">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Password Saat Ini</label>
                                        <input type="password" name="current_password" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none text-sm font-medium">
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1 text-xs text-red-500 font-semibold" />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Password Baru</label>
                                        <input type="password" name="password" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none text-sm font-medium">
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1 text-xs text-red-500 font-semibold" />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none text-sm font-medium">
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1 text-xs text-red-500 font-semibold" />
                                    </div>
                                </div>

                                {{-- UI/UX  --}}
                                <div class="flex items-center justify-end mt-2">
                                    <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                                        <i class="fas fa-lock"></i> Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- HAPUS AKUN --}}
                    <div id="delete" class="tab-content hidden">
                        <div class="bg-red-50/50 p-6 md:p-8 rounded-2xl shadow-sm border border-red-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b border-red-100">Hapus Akun Permanen</h3>
                            
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-lg flex-shrink-0">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-red-800">Peringatan Penghapusan Akun</p>
                                        <p class="text-xs text-red-600/80 mt-1 leading-relaxed max-w-sm">Data tidak bisa dikembalikan. Sekali akun dihapus, semua sumber daya dan data Anda akan hilang permanen.</p>
                                    </div>
                                </div>
                                
                                <form method="post" action="{{ route('profile.destroy') }}" class="w-full md:w-auto flex-shrink-0">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Apakah Anda yakin ingin menghapus akun?')" type="submit" class="w-full md:w-auto bg-red-600 text-white px-6 py-3 rounded-lg text-xs font-bold hover:bg-red-700 transition shadow-sm">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus Akun
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabId, btnElement) {
            document.querySelectorAll('.tab-content').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('block');
            });
            
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-blue-50', 'text-blue-700', 'font-bold');
                btn.classList.add('text-gray-600', 'font-medium');
                
                if(btn.innerText.includes('Hapus')) {
                    btn.classList.remove('bg-red-50', 'text-red-700');
                    btn.classList.add('text-red-500');
                }
            });

            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('block');
            
            if(tabId === 'delete') {
                btnElement.classList.add('bg-red-50', 'text-red-700', 'font-bold');
                btnElement.classList.remove('text-red-500', 'font-medium');
            } else {
                btnElement.classList.add('bg-blue-50', 'text-blue-700', 'font-bold');
                btnElement.classList.remove('text-gray-600', 'font-medium');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast-success');
            if (toast) {
                setTimeout(() => {
                    toast.classList.remove('opacity-100');
                    toast.classList.add('opacity-0');
                    setTimeout(() => toast.remove(), 500); 
                }, 2500);
            }
        });
    </script>
</x-app-layout>