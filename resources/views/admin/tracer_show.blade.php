@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Detail Data Tracer Study</h1>
                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    <a href="{{ route('admin.tracer.edit', $tracer) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-md text-center transition-colors">
                        Edit Data
                    </a>
                    <a href="{{ route('admin.tracer.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md text-center transition-colors">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>

            <!-- Alumni Information Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                <div class="px-6 py-4 bg-blue-50 border-b border-blue-100">
                    <h2 class="text-xl font-semibold text-blue-800">Informasi Alumni</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Alumni Data -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-800 mb-4 pb-2 border-b border-gray-200">Data Alumni
                            </h3>
                            <dl class="space-y-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Nama</dt>
                                    <dd class="col-span-2 text-sm text-gray-900">{{ $tracer->alumni->nama ?? 'N/A' }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">NIM</dt>
                                    <dd class="col-span-2 text-sm text-gray-900">{{ $tracer->alumni->nim ?? 'N/A' }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="col-span-2 text-sm text-gray-900 break-all">
                                        {{ $tracer->alumni->email ?? 'N/A' }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Program Studi</dt>
                                    <dd class="col-span-2 text-sm text-gray-900">
                                        {{ $tracer->alumni->program_studi ?? 'N/A' }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Tahun Lulus</dt>
                                    <dd class="col-span-2 text-sm text-gray-900">{{ $tracer->alumni->tahun_lulus ?? 'N/A' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Tracer Data -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-800 mb-4 pb-2 border-b border-gray-200">Data Tracer
                                Study</h3>
                            <dl class="space-y-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="col-span-2 text-sm text-gray-900 capitalize">{{ $tracer->status }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Tanggal Mulai</dt>
                                    <dd class="col-span-2 text-sm text-gray-900">
                                        {{ $tracer->tanggal_mulai->format('d F Y') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Details Section -->
            @php
                $status = $tracer->status;
                $soalLabels = [
                    'bekerja' => [
                        'Lama mendapatkan pekerjaan',
                        'Rata-rata pendapatan per bulan',
                        'Lokasi (Provinsi)',
                        'Lokasi (Kota/Kabupaten)',
                        'Jenis Perusahaan',
                        'Nama Perusahaan',
                        'Kategori perusahaan',
                        'Sumber informasi pekerjaan',
                    ],
                    'wiraswasta' => [
                        'Jabatan/Posisi',
                        'Nama Usaha',
                        'Pendapatan per bulan',
                        'Bidang Usaha',
                        'Lama memulai usaha',
                    ],
                    'melanjutkan' => [
                        'Jenjang pendidikan',
                        'Nama Perguruan Tinggi',
                        'Program Studi',
                        'Tanggal Masuk',
                        'Sumber Biaya',
                    ],
                    'tidak bekerja' => [
                        'Jumlah perusahaan yang dilamar',
                        'Perusahaan yang merespons',
                        'Undangan wawancara',
                    ],
                ];

                // Get answer data based on status
                $jawaban = null;
                if ($status == 'bekerja') {
                    $jawaban = $tracer->alumni->bekerja ?? null;
                } elseif ($status == 'wiraswasta') {
                    $jawaban = $tracer->alumni->wiraswasta ?? null;
                } elseif ($status == 'melanjutkan') {
                    $jawaban = $tracer->alumni->melanjutkanPendidikan ?? null;
                } elseif ($status == 'tidak bekerja') {
                    $jawaban = $tracer->alumni->tidakBekerja ?? null;
                }
            @endphp

            @if ($jawaban)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 bg-blue-50 border-b border-blue-100">
                        <h2 class="text-xl font-semibold text-blue-800">Detail {{ ucwords($status) }}</h2>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($soalLabels[$status] as $i => $label)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 w-1/3">
                                                {{ $label }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">
                                                {{ $jawaban->{'soal_' . ($i + 1)} ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 bg-yellow-50 border-b border-yellow-100">
                        <h2 class="text-xl font-semibold text-yellow-800">Detail {{ ucwords($status) }}</h2>
                    </div>
                    <div class="p-6 text-center text-gray-500">
                        <p>Data detail untuk status ini belum tersedia</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
