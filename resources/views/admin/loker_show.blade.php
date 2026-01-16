@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Lowongan Kerja</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            Informasi Lowongan
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h4>{{ $loker->judul }}</h4>
                <p class="text-muted">
                    {{ $loker->perusahaan }} - {{ $loker->lokasi }}
                </p>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tanggal Mulai:</strong>
                    <p>{{ $loker->tanggal_mulai->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Tanggal Selesai:</strong>
                    <p>{{ $loker->tanggal_selesai->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="mb-3">
                <strong>Deskripsi:</strong>
                <p class="mt-2">{!! nl2br(e($loker->deskripsi)) !!}</p>
            </div>

            <div class="mb-3">
                <strong>Kontak:</strong>
                <p>{{ $loker->kontak }}</p>
            </div>

            <div class="mb-3">
                <a href="{{ route('admin.loker.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('admin.loker.edit', $loker) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.loker.destroy', $loker) }}" method="POST" class="d-inline">
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
