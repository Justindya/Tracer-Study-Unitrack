@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50 min-h-screen font-sans relative">
    
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        
        <a href="{{ route('profile.edit') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 font-medium mb-6 text-sm transition focus:outline-none">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Pengaturan
        </a>
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Biodata</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi profil publik Anda untuk menarik perhatian HRD.</p>
        </div>

        <form action="{{ route('user.alumni.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- KELOMPOK 1: DATA PERSONAL --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Data Personal</h2>
                </div>
                
                <div class="p-6 md:p-8 space-y-6">
                    {{-- FOTO PROFIL --}}
                    <div class="flex items-center gap-6 pb-2">
                        <div class="relative group cursor-pointer">
                            @if ($alumni->Foto)
                                <img src="{{ asset('storage/' . $alumni->Foto) }}" class="w-20 h-20 rounded-full object-cover border-4 border-gray-50 shadow-sm group-hover:border-blue-100 transition">
                            @else
                                <div class="w-20 h-20 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 text-2xl border-4 border-white shadow-sm">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-1.5 border-2 border-white shadow-sm">
                                <i class="fas fa-camera text-[10px]"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-gray-800 mb-1">Ganti Foto Profil</label>
                            <input type="file" name="Foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer transition">
                            <p class="text-xs text-gray-400 mt-1.5">Format: JPG, PNG. Maksimal ukuran 2MB.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ $alumni->nama }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium transition outline-none" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">NIM</label>
                            <input type="text" name="nim" value="{{ $alumni->nim }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-100 text-gray-500 text-sm font-medium cursor-not-allowed outline-none" readonly title="NIM tidak dapat diubah">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Email Kontak</label>
                            <input type="email" name="email" value="{{ $alumni->email }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium transition outline-none" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">No HP / WhatsApp</label>
                            <input type="text" name="no_hp" value="{{ $alumni->no_hp }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium transition outline-none" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Jenis Kelamin</label>
                        <div class="relative">
                            <select name="jenis_kelamin" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium bg-white appearance-none outline-none">
                                <option value="laki-laki" {{ $alumni->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ $alumni->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Alamat Domisili</label>
                        <textarea name="alamat" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium transition outline-none resize-y" required>{{ $alumni->alamat }}</textarea>
                    </div>
                </div>
            </div>

            {{-- KELOMPOK 2: AKADEMIK & KARIR --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 border border-indigo-100">
                        <i class="fas fa-graduation-cap text-sm"></i>
                    </div>
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Akademik & Karir</h2>
                </div>

                <div class="p-6 md:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Angkatan</label>
                            <input type="text" name="angkatan" value="{{ $alumni->angkatan }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium transition outline-none" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Tahun Lulus</label>
                            <input type="text" name="tahun_lulus" value="{{ $alumni->tahun_lulus }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium transition outline-none" placeholder="Isi '-' jika masih menempuh studi" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Program Studi</label>
                        <div class="relative">
                            <select name="program_studi" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium bg-white appearance-none outline-none">
                                <option value="Sistem Informasi" {{ $alumni->program_studi == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                <option value="Bisnis Digital" {{ $alumni->program_studi == 'Bisnis Digital' ? 'selected' : '' }}>Bisnis Digital</option>
                                <option value="Gizi" {{ $alumni->program_studi == 'Gizi' ? 'selected' : '' }}>Gizi</option>
                                <option value="{{ $alumni->program_studi }}" selected>{{ $alumni->program_studi }}</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Link Profil LinkedIn</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fab fa-linkedin text-blue-600 text-lg"></i>
                            </div>
                            <input type="url" name="linkedin" value="{{ $alumni->linkedin }}" class="w-full pl-11 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium transition outline-none" placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Keahlian / Skill Utama</label>
                        <textarea name="skill" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium transition outline-none resize-y" placeholder="Contoh: Pemrograman PHP, Desain UI/UX, Analisis Data">{{ $alumni->skill }}</textarea>
                        <p class="text-xs text-gray-400 mt-1.5 font-medium"><i class="fas fa-info-circle mr-1"></i> Pisahkan setiap skill dengan tanda koma (,).</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Bio / Tentang Saya</label>
                        <textarea name="bio" rows="5" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-sm font-medium transition outline-none resize-y" placeholder="Ceritakan pengalaman profesional, pencapaian, atau minat karir Anda secara singkat...">{{ $alumni->bio }}</textarea>
                    </div>
                </div>
            </div>

            {{-- TOMBOL AKSI DI BAWAH --}}
            <div class="flex items-center justify-end gap-3 pb-12 border-t border-gray-200 pt-6">
                <a href="{{ route('profile.edit') }}" class="bg-white border border-gray-200 text-gray-700 px-6 py-2.5 rounded-lg font-bold text-sm hover:bg-gray-50 transition shadow-sm text-center">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-bold text-sm hover:bg-blue-700 transition shadow-sm flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection