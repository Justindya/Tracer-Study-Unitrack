@extends('layouts.app')

@section('content')
<div class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-ush-blue px-8 py-10 text-white relative">
                <div class="relative z-10">
                    <h2 class="text-3xl font-extrabold tracking-tight">Usulkan Lowongan Kerja</h2>
                    <p class="mt-2 text-blue-100 opacity-90">Bagikan peluang karir untuk rekan-rekan mahasiswa dan alumni lainnya.</p>
                </div>
            </div>

            <form action="{{ route('user.lokers.propose.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Judul Lowongan</label>
                        <input type="text" name="judul" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" placeholder="Contoh: Senior Web Developer" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Posisi yang Dibutuhkan</label>
                        <input type="text" name="posisi" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" placeholder="Contoh: Fullstack Engineer" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Nama Perusahaan</label>
                        <input type="text" name="perusahaan" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" placeholder="Nama PT atau CV" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Jenis Perusahaan</label>
                        <select name="jenis_perusahaan" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" required>
                            <option value="">Pilih Jenis</option>
                            <option value="PT">PT</option>
                            <option value="CV">CV</option>
                            <option value="Startup">Startup</option>
                            <option value="BUMN">BUMN</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Email Perusahaan</label>
                        <input type="email" name="email_perusahaan" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" placeholder="hrd@perusahaan.com" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Jumlah yang Dibutuhkan</label>
                        <input type="number" name="jumlah_dibutuhkan" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" placeholder="Contoh: 5" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Lokasi</label>
                        <input type="text" name="lokasi" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" placeholder="Kota atau Alamat" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Narahubung / Kontak</label>
                        <input type="text" name="kontak" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" placeholder="No. WA atau Email" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Deskripsi Pekerjaan & Syarat</label>
                    <textarea name="deskripsi" rows="6" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200" placeholder="Tuliskan kualifikasi, tanggung jawab, dan Benefit..." required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Poster Lowongan (Opsional)</label>
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-2xl hover:border-blue-400 transition duration-200 bg-gray-50">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="poster" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>Upload file</span>
                                    <input id="poster" name="poster" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('user.lokers.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                    <button type="submit" class="px-10 py-3 bg-ush-blue text-white rounded-xl font-bold shadow-lg shadow-blue-900/20 hover:bg-blue-800 transform hover:-translate-y-0.5 transition duration-200">
                        Kirim Usulan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
