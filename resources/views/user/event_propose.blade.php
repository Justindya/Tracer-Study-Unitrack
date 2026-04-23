@extends('layouts.app')

@section('content')
<div class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-indigo-600 px-8 py-10 text-white relative">
                <div class="relative z-10">
                    <h2 class="text-3xl font-extrabold tracking-tight">Usulkan Event Kampus</h2>
                    <p class="mt-2 text-indigo-100 opacity-90">Bagikan acara bermanfaat untuk komunitas mahasiswa dan alumni.</p>
                </div>
            </div>

            <form action="{{ route('user.events.propose.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Judul Event</label>
                        <input type="text" name="judul" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition duration-200" placeholder="Contoh: Webinar Karir IT" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Tema Event</label>
                        <input type="text" name="tema" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition duration-200" placeholder="Contoh: Persiapan Dunia Kerja" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Tempat / Platform</label>
                        <input type="text" name="tempat" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition duration-200" placeholder="Contoh: Zoom Meeting atau Aula Kampus" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Pembicara / Narasumber</label>
                        <input type="text" name="pembicara" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition duration-200" placeholder="Contoh: Bpk. Sugeng Hartono" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Tanggal</label>
                        <input type="date" name="tanggal" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition duration-200" required>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Jam Mulai</label>
                        <input type="time" name="jam" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition duration-200" required>
                    </div>

                    <div class="col-span-1" x-data="{ isPaid: false }">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Jenis Pendaftaran</label>
                        <div class="flex items-center gap-4 py-3">
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_paid" value="0" @click="isPaid = false" checked class="form-radio text-indigo-600">
                                <span class="ml-2">Gratis</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_paid" value="1" @click="isPaid = true" class="form-radio text-indigo-600">
                                <span class="ml-2">Berbayar</span>
                            </label>
                        </div>
                        <div x-show="isPaid" class="mt-2">
                            <input type="number" name="harga" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition duration-200" placeholder="Harga Tiket (Rp)">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Detail Acara / Agenda</label>
                    <textarea name="deskripsi" rows="6" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition duration-200" placeholder="Tuliskan detail agenda acara, rundown, dsb..." required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Poster Event (Opsional)</label>
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-2xl hover:border-indigo-400 transition duration-200 bg-gray-50">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-file-image text-gray-400 text-3xl mb-2"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="poster" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
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
                    <a href="{{ route('user.events.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                    <button type="submit" class="px-10 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-900/20 hover:bg-indigo-700 transform hover:-translate-y-0.5 transition duration-200">
                        Kirim Usulan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
