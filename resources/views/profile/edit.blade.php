<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row gap-8">
                
                <div class="w-full md:w-1/4">
                    <div class="bg-white p-6 rounded-2xl shadow-sm text-center sticky top-24 border border-gray-100">
                        <div class="w-28 h-28 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-4xl font-bold border-4 border-blue-100 shadow-sm">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        
                        <h2 class="text-xl font-bold text-gray-900 break-words">{{ $user->name }}</h2>
                        <p class="text-gray-500 text-sm mb-6">{{ $user->email }}</p>

                        <nav class="mt-8 text-left space-y-1">
                            <a href="#info" class="flex items-center px-3 py-2 text-blue-600 font-bold text-sm bg-blue-50 rounded-lg transition">
                                <i class="fas fa-user w-6"></i> Informasi Pribadi
                            </a>
                            <a href="#skills" class="flex items-center px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg text-sm transition">
                                <i class="fas fa-star w-6"></i> Skills
                            </a>
                            <a href="#password" class="flex items-center px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg text-sm transition">
                                <i class="fas fa-lock w-6"></i> Password
                            </a>
                            <a href="#delete" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-50 rounded-lg text-sm transition mt-4 pt-4 border-t">
                                <i class="fas fa-trash-alt w-6"></i> Hapus Akun
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="w-full md:w-3/4 space-y-6">
                    
                    <div id="info" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 scroll-mt-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 pb-4 border-b">Informasi Pribadi</h3>
                        
                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm" required>
                                </div>
                                
                                <div class="md:col-span-2 bg-blue-50 p-4 rounded-xl border border-blue-100 flex items-start gap-3">
                                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                                    <div>
                                        <h4 class="text-sm font-bold text-blue-700">Data Akademik & Kontak</h4>
                                        <p class="text-xs text-blue-600 mt-1">
                                            Data seperti Nomor Telepon, NIM, Jurusan, dan Tahun Lulus dikelola melalui menu 
                                            <a href="{{ route('user.alumni.index') }}" class="underline font-bold">Data Alumni</a>, bukan di halaman ini.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="bg-gray-900 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-black transition shadow-sm">
                                    Simpan Perubahan
                                </button>
                                @if (session('status') === 'profile-updated')
                                    <span class="text-sm text-green-600 font-medium animate-pulse"><i class="fas fa-check-circle mr-1"></i> Tersimpan.</span>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div id="skills" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 scroll-mt-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Skills & Keahlian</h3>
                        <p class="text-sm text-gray-500 mb-6 pb-4 border-b">Tambahkan keahlian yang Anda miliki (Data tersimpan di browser ini).</p>
                        
                        <div id="skill-list" class="flex flex-wrap gap-2 mb-6 min-h-[40px]">
                            </div>

                        <div class="flex gap-3">
                            <input type="text" id="skill-input" placeholder="Contoh: Laravel, Desain Grafis..." class="flex-1 px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm">
                            <button onclick="addSkill()" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>

                    <div id="password" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 scroll-mt-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 pb-4 border-b">Update Password</h3>
                        
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="space-y-4 mb-6 max-w-md">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
                                    <input type="password" name="current_password" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm">
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                    <input type="password" name="password" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm">
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm">
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="bg-gray-900 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-black transition shadow-sm">
                                    Update Password
                                </button>
                                @if (session('status') === 'password-updated')
                                    <span class="text-sm text-green-600 font-medium"><i class="fas fa-check-circle mr-1"></i> Berhasil diubah.</span>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div id="delete" class="bg-red-50 p-8 rounded-2xl shadow-sm border border-red-100 scroll-mt-24">
                        <h3 class="text-lg font-bold text-red-700 mb-2">Hapus Akun Secara Permanen</h3>
                        <p class="text-red-600/80 text-sm mb-6 pb-4 border-b border-red-200">
                            Tindakan ini tidak dapat dibatalkan. Semua data profil, riwayat, dan bookmark Anda akan dihapus permanen.
                        </p>
                        
                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('APAKAH ANDA YAKIN? Tindakan ini tidak bisa dibatalkan.')" type="submit" class="bg-red-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-red-700 transition shadow-sm flex items-center gap-2">
                                <i class="fas fa-exclamation-triangle"></i> Hapus Akun Saya
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function renderSkills() {
            const skills = JSON.parse(localStorage.getItem('user_skills') || '[]');
            const container = document.getElementById('skill-list');
            container.innerHTML = '';

            if(skills.length === 0) {
                 container.innerHTML = '<span class="text-gray-400 text-sm italic">Belum ada skill ditambahkan.</span>';
            } else {
                skills.forEach((skill, index) => {
                    const tag = `
                        <span class="bg-blue-50 text-blue-600 pl-3 pr-2 py-1.5 rounded-lg text-sm font-semibold flex items-center gap-2 border border-blue-100">
                            ${skill}
                            <button onclick="removeSkill(${index})" class="text-blue-400 hover:text-red-500 hover:bg-red-50 rounded p-0.5 transition">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </span>
                    `;
                    container.innerHTML += tag;
                });
            }
        }

        function addSkill() {
            const input = document.getElementById('skill-input');
            const val = input.value.trim();
            if (val) {
                let skills = JSON.parse(localStorage.getItem('user_skills') || '[]');
                // Cek duplikasi (case insensitive)
                if (!skills.some(s => s.toLowerCase() === val.toLowerCase())) {
                    skills.push(val);
                    localStorage.setItem('user_skills', JSON.stringify(skills));
                    renderSkills();
                } else {
                    alert('Skill tersebut sudah ada.');
                }
                input.value = '';
            }
        }

        function removeSkill(index) {
            let skills = JSON.parse(localStorage.getItem('user_skills') || '[]');
            skills.splice(index, 1);
            localStorage.setItem('user_skills', JSON.stringify(skills));
            renderSkills();
        }

        // Tambah skill dengan tombol Enter
        document.getElementById('skill-input').addEventListener('keypress', function(e) {
            if(e.key === 'Enter') {
                e.preventDefault();
                addSkill();
            }
        });

        document.addEventListener('DOMContentLoaded', renderSkills);
    </script>
</x-app-layout>