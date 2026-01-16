@extends('layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Lowongan Kerja</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-info-circle me-1"></i>
                Informasi alumni
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama Lengkap:</strong>
                        <p>{{ $alumni->nama }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>NIM:</strong>
                        <p>{{ $alumni->nim }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p>{{ $alumni->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>No HP:</strong>
                        <p>{{ $alumni->no_hp }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Angkatan:</strong>
                        <p>{{ $alumni->angkatan }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Tahun Lulus:</strong>
                        <p>{{ $alumni->tahun_lulus }}</p>
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Program Studi :</strong>
                    <p>{{ $alumni->program_studi }}</p>
                </div>

                <div class="mb-3">
                    <strong>Jenis Kelamin :</strong>
                    <p>{{ $alumni->jenis_kelamin }}</p>
                </div>

                <div class="mb-3">
                    <strong>Deskripsi:</strong>
                    <p class="mt-2">{!! nl2br(e($alumni->alamat)) !!}</p>
                </div>
                <div class="mb-3">
                    <strong>Foto:</strong>
                    @if ($alumni->Foto)
                        <img src="{{ asset('storage/' . $alumni->Foto) }}" width="200" class="d-block mb-2">
                    @else
                        <p>Tidak ada foto</p>
                    @endif
                </div>


                <div class="mb-3">
                    <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('admin.alumni.export.single', $alumni->id) }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Export Data Alumni
                    </a>
                    <a href="{{ route('admin.alumni.edit', $alumni) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.alumni.destroy', $alumni) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
