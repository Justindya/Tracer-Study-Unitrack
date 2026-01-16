@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Lowongan Kerja</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            Informasi Event
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h4>{{ $event->judul }}</h4>
                <p class="text-muted">
                    {{ $event->tempat }}
                </p>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tanggal Event:</strong>
                    <p>{{ $event->tanggal->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="mb-3">
                <strong>Jam :</strong>
                <p>{{ $event->jam }}</p>
            </div>

            <div class="mb-3">
                <strong>Deskripsi:</strong>
                <p class="mt-2">{!! nl2br(e($event->deskripsi)) !!}</p>
            </div>


            <div class="mb-3">
                <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('admin.event.edit', $event) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.event.destroy', $event) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
