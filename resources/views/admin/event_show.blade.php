@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-6">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Event</h1>
        <a href="{{ route('admin.event.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-white font-bold text-primary">
            <i class="fas fa-info-circle me-1"></i> Informasi Event
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h2 class="h4 fw-bold text-dark">{{ $event->judul }}</h2>
                <span class="badge bg-info text-dark"><i class="fas fa-map-marker-alt"></i> {{ $event->tempat }}</span>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong class="text-muted small">TANGGAL</strong>
                    <p class="fw-bold">{{ $event->tanggal->format('d F Y') }}</p>
                </div>
                <div class="col-md-6">
                    <strong class="text-muted small">WAKTU</strong>
                    <p class="fw-bold">{{ $event->jam }} WIB</p>
                </div>
            </div>

            <div class="mb-4">
                <strong class="text-muted small">DESKRIPSI</strong>
                <div class="p-3 bg-light rounded mt-1 border">
                    {!! nl2br(e($event->deskripsi)) !!}
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.event.edit', $event) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit"></i> Edit Event
                </a>
                <form action="{{ route('admin.event.destroy', $event) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white font-bold text-success d-flex justify-content-between align-items-center">
            <span><i class="fas fa-users me-1"></i> Pendaftar Event ({{ $event->participants->count() }})</span>
            <button class="btn btn-sm btn-outline-success" onclick="window.print()">Cetak Absensi</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Nama Peserta</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($event->participants as $user)
                            <tr>
                                <td class="ps-4">{{ $loop->iteration }}</td>
                                <td class="fw-bold">
                                    {{ $user->name }}
                                    @if($user->alumni)
                                        <span class="badge bg-secondary ms-1" style="font-size: 0.6em;">Alumni {{ $user->alumni->angkatan }}</span>
                                    @endif
                                </td>
                                <td>{{ $user->nim }}</td>
                                <td>{{ $user->alumni->program_studi ?? '-' }}</td>
                                <td class="text-muted small">
                                    {{ \Carbon\Carbon::parse($user->pivot->created_at)->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-slash fa-2x mb-3 d-block opacity-25"></i>
                                    Belum ada peserta yang mendaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection