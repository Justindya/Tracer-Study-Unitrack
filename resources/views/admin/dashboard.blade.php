@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h1 class="text-center fs-1">Admin Dashboard</h1>
        <p class="text-center fs-2">Selamat datang di dashboard admin.</p>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Alumni</h5>
                        <p class="card-text display-6">{{ \App\Models\User::count() }}</p>
                        <a href="{{ route('admin.alumni.index') }}" class="text-white">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Event</h5>
                        <p class="card-text display-6">{{ \App\Models\event::count() }}</p>
                        <a href="{{ route('admin.event.index') }}" class="text-white">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Loker</h5>
                        <p class="card-text display-6">{{ \App\Models\loker::count() }}</p>
                        <a href="{{ route('admin.loker.index') }}" class="text-white">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Kusioner</h5>
                        <p class="card-text display-6">{{ \App\Models\kusioner::count() }}</p>
                        <a href="{{ route('admin.kusioner.index') }}" class="text-white">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tracer Study</h5>
                        <p class="card-text display-6">{{ \App\Models\tracer::count() }}</p>
                        <a href="{{ route('admin.tracer.index') }}" class="text-white">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Grafik Tracer Study berdasarkan Gender</h5>
                        <div>
                            <a href="{{ route('admin.alumni.export.all') }}" class="btn btn-success btn-sm me-2">
                                <i class="fas fa-file-excel"></i> Export Alumni
                            </a>
                            <a href="{{ route('admin.tracer.export.all') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-file-excel"></i> Export Tracer
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="position: relative; height: 400px; width: 100%;">
                            <canvas id="tracerGenderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Statistik Tracer</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h6 class="text-primary">Laki-laki</h6>
                                    <p class="h4 text-primary">{{ $tracerMale }}</p>
                                    <small class="text-muted">dari {{ $totalMale }} alumni</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h6 class="text-danger">Perempuan</h6>
                                    <p class="h4 text-danger">{{ $tracerFemale }}</p>
                                    <small class="text-muted">dari {{ $totalFemale }} alumni</small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <h6>Total Alumni</h6>
                            <p class="h3">{{ $totalAlumni }}</p>
                            <small class="text-muted">dengan tracer: {{ $totalTracer }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data untuk grafik
        const ctx = document.getElementById('tracerGenderChart').getContext('2d');
        const tracerGenderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    label: 'Alumni dengan Tracer',
                    data: [{{ $tracerMale }}, {{ $tracerFemale }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)', // Biru untuk laki-laki
                        'rgba(255, 192, 203, 0.8)' // Pink untuk perempuan
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 192, 203, 1)'
                    ],
                    borderWidth: 2
                }, {
                    label: 'Total Alumni',
                    data: [{{ $totalMale }}, {{ $totalFemale }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.3)',
                        'rgba(255, 192, 203, 0.3)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 192, 203, 0.5)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Mencegah perubahan aspect ratio
                animation: false, // Menonaktifkan animasi
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Alumni'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Jenis Kelamin'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Perbandingan Alumni dengan Tracer Study'
                    }
                }
            }
        });
    </script>
@endsection
