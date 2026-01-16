@extends('layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Kuesioner</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-question-circle me-1"></i>
                Informasi Kuesioner
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h4>Pertanyaan:</h4>
                    <p class="fs-5">{{ $kusioner->soal }}</p>

                    <div class="mt-3">
                        <h5>Pilihan Jawaban:</h5>
                        <ul class="list-group">
                            <li class="list-group-item">A. {{ $kusioner->pilihan_a }}</li>
                            <li class="list-group-item">B. {{ $kusioner->pilihan_b }}</li>
                            <li class="list-group-item">C. {{ $kusioner->pilihan_c }}</li>
                            <li class="list-group-item">D. {{ $kusioner->pilihan_d }}</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4">
                    <h4>Jawaban Alumni:</h4>
                    @if ($jawabans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Alumni</th>
                                        <th>NIM</th>
                                        <th>Jawaban</th>
                                        <th>Waktu Menjawab</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jawabans as $index => $jawaban)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $jawaban->user->name }}</td>
                                            <td>{{ $jawaban->user->nim }}</td>
                                            <td>
                                                @switch($jawaban->jawaban)
                                                    @case('A')
                                                        {{ $kusioner->pilihan_a }}
                                                    @break

                                                    @case('B')
                                                        {{ $kusioner->pilihan_b }}
                                                    @break

                                                    @case('C')
                                                        {{ $kusioner->pilihan_c }}
                                                    @break

                                                    @case('D')
                                                        {{ $kusioner->pilihan_d }}
                                                    @break

                                                    @default
                                                        {{ $jawaban->jawaban }}
                                                @endswitch
                                            </td>
                                            <td>{{ $jawaban->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <h5>Statistik Jawaban:</h5>
                            @php
                                $stats = $jawabans->groupBy('jawaban')->map(function ($group) use ($jawabans) {
                                    return [
                                        'count' => $group->count(),
                                        'percentage' => round(($group->count() / $jawabans->count()) * 100, 1),
                                    ];
                                });
                            @endphp

                            <div class="list-group">
                                <div class="list-group-item">
                                    <h6>A. {{ $kusioner->pilihan_a }}</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $stats['A']['percentage'] ?? 0 }}%">
                                            {{ $stats['A']['count'] ?? 0 }} responden
                                            ({{ $stats['A']['percentage'] ?? 0 }}%)
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <h6>B. {{ $kusioner->pilihan_b }}</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $stats['B']['percentage'] ?? 0 }}%">
                                            {{ $stats['B']['count'] ?? 0 }} responden
                                            ({{ $stats['B']['percentage'] ?? 0 }}%)
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <h6>C. {{ $kusioner->pilihan_c }}</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $stats['C']['percentage'] ?? 0 }}%">
                                            {{ $stats['C']['count'] ?? 0 }} responden
                                            ({{ $stats['C']['percentage'] ?? 0 }}%)
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <h6>D. {{ $kusioner->pilihan_d }}</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $stats['D']['percentage'] ?? 0 }}%">
                                            {{ $stats['D']['count'] ?? 0 }} responden
                                            ({{ $stats['D']['percentage'] ?? 0 }}%)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Belum ada alumni yang menjawab kuesioner ini.
                        </div>
                    @endif
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.kusioner.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('admin.kusioner.edit', $kusioner) }}" class="btn btn-warning">Edit Kuesioner</a>
                </div>
            </div>
        </div>
    </div>
@endsection
