<div class="mb-6">
    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status Saat Ini</label>
    <div class="relative">
        <select name="status" id="status" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none bg-white appearance-none transition cursor-pointer" required>
            <option value="">-- Pilih Status --</option>
            <option value="bekerja" {{ old('status', $tracer->status ?? '') == 'bekerja' ? 'selected' : '' }}>Bekerja</option>
            <option value="wiraswasta" {{ old('status', $tracer->status ?? '') == 'wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
            <option value="melanjutkan_pendidikan" {{ old('status', $tracer->status ?? '') == 'melanjutkan_pendidikan' ? 'selected' : '' }}>Melanjutkan Pendidikan</option>
            <option value="tidak_bekerja" {{ old('status', $tracer->status ?? '') == 'tidak_bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
        </select>
        
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
            <i class="fas fa-chevron-down text-xs"></i>
        </div>
    </div>
</div>

<div class="mb-6">
    <label for="tanggal_mulai" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
           value="{{ old('tanggal_mulai', isset($tracer) ? \Carbon\Carbon::parse($tracer->tanggal_mulai)->format('Y-m-d') : '') }}" required>
</div>

{{-- Container untuk Form Dinamis --}}
<div id="soal-form" class="space-y-6 mt-8"></div>

<script>
    const statusQuestions = {
        'bekerja': [
            'Berapa lama anda mendapatkan pekerjaan?',
            'Berapa rata-rata pendapatan per bulan anda (Take Home Pay)?',
            'Lokasi Tempat Anda Bekerja (Provinsi)',
            'Lokasi Tempat Anda Bekerja (Kota / Kabupaten)',
            'Jenis Perusahaan tempat anda bekerja',
            'Nama Perusahaan tempat anda bekerja',
            'Kategori perusahaan tempat anda bekerja',
            'Informasi yang anda dapatkan untuk mencari pekerjaan'
        ],
        'wiraswasta': [
            'Apakah jabatan/posisi anda ketika Berwirausaha?',
            'Nama Usaha anda',
            'Pendapatan per bulan anda',
            'Bidang Usaha',
            'Berapa lama anda memulai usaha?'
        ],
        'melanjutkan_pendidikan': [
            'Jenjang melanjutkan',
            'Nama Perguruan Tinggi',
            'Nama Program Studi',
            'Tanggal Bulan Tahun Masuk',
            'Sumber Biaya'
        ],
        'tidak_bekerja': [
            'Berapa perusahaan/instansi yang sudah anda lamar?',
            'Berapa banyak respons lamaran anda?',
            'Berapa banyak undangan wawancara?'
        ]
    };

    function renderSoal(status, values = {}) {
        const container = document.getElementById('soal-form');
        container.innerHTML = '';

        let normalizedStatus = status;
        if(status === 'melanjutkan') normalizedStatus = 'melanjutkan_pendidikan';
        if(status === 'tidak bekerja') normalizedStatus = 'tidak_bekerja';

        if (!normalizedStatus || !statusQuestions[normalizedStatus]) return;

        let headerText = '';
        let headerColor = '';
        if (normalizedStatus === 'bekerja') { headerText = 'Detail Pekerjaan'; headerColor = 'text-blue-600'; }
        else if (normalizedStatus === 'wiraswasta') { headerText = 'Detail Usaha'; headerColor = 'text-green-600'; }
        else if (normalizedStatus === 'melanjutkan_pendidikan') { headerText = 'Detail Pendidikan Lanjutan'; headerColor = 'text-purple-600'; }
        else if (normalizedStatus === 'tidak_bekerja') { headerText = 'Informasi Pencarian Kerja'; headerColor = 'text-amber-600'; }

        container.innerHTML = `
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 mt-4 mb-6">
                <h3 class="font-bold ${headerColor} border-b pb-2 mb-6">${headerText}</h3>
                <div id="questions-wrapper" class="space-y-6"></div>
            </div>
        `;

        const wrapper = document.getElementById('questions-wrapper');

        statusQuestions[normalizedStatus].forEach((question, index) => {
            const questionNumber = index + 1;
            const fieldName = `soal_${questionNumber}`;
            const fieldValue = values[fieldName] || '';

            const questionElement = document.createElement('div');
            
            questionElement.innerHTML = `
                <label class="block text-gray-700 text-sm font-bold mb-2">${question}</label>
                <input type="text"
                       name="${fieldName}"
                       placeholder="Jawaban Anda..."
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                       value="${fieldValue.replace(/"/g, '&quot;')}"
                       required>
            `;

            wrapper.appendChild(questionElement);
        });
    }

    document.getElementById('status').addEventListener('change', function() {
        renderSoal(this.value);
    });

    @php
        $currentStatus = old('status', $tracer->status ?? '');
        $initialValues = [];
        
        if (isset($tracer)) {
            if ($tracer->status == 'bekerja' && $tracer->alumni->bekerja) {
                $initialValues = $tracer->alumni->bekerja->toArray();
            } elseif ($tracer->status == 'wiraswasta' && $tracer->alumni->wiraswasta) {
                $initialValues = $tracer->alumni->wiraswasta->toArray();
            } elseif ($tracer->status == 'melanjutkan_pendidikan' && $tracer->alumni->melanjutkanPendidikan) {
                $initialValues = $tracer->alumni->melanjutkanPendidikan->toArray();
            } elseif ($tracer->status == 'tidak_bekerja' && $tracer->alumni->tidakBekerja) {
                $initialValues = $tracer->alumni->tidakBekerja->toArray();
            }
        }

        for ($i = 1; $i <= 8; $i++) {
            $initialValues["soal_$i"] = old("soal_$i", $initialValues["soal_$i"] ?? '');
        }
    @endphp

    window.addEventListener('DOMContentLoaded', function() {
        const status = @json($currentStatus);
        const initialValues = @json($initialValues);
        
        if (status) {
            renderSoal(status, initialValues);
        }
    });
</script>