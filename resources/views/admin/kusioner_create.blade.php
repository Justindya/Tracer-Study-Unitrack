@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Kusioner</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i>
            Form Tambah Kusioner
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kusioner.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="soal" class="form-label">Soal</label>
                    <input type="text" class="form-control @error('soal') is-invalid @enderror"
                           id="soal" name="soal" value="{{ old('soal') }}" required>
                    @error('soal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pilihan_a" class="form-label">Pilihan a</label>
                    <input type="text" class="form-control @error('pilihan_a') is-invalid @enderror"
                           id="pilihan_a" name="pilihan_a" value="{{ old('pilihan_a') }}" required>
                    @error('pilihan_a')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pilihan_b" class="form-label">pilihan_b</label>
                    <input type="text" class="form-control @error('pilihan_b') is-invalid @enderror"
                           id="pilihan_b" name="pilihan_b" value="{{ old('pilihan_b') }}" required>
                    @error('pilihan_b')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pilihan_c" class="form-label">Pilihan c</label>
                    <input type="text" class="form-control @error('pilihan_c') is-invalid @enderror"
                           id="pilihan_c" name="pilihan_c" value="{{ old('pilihan_c') }}" required>
                    @error('pilihan_c')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pilihan_d" class="form-label">Pilihan d</label>
                    <input type="text" class="form-control @error('pilihan_d') is-invalid @enderror"
                           id="pilihan_d" name="pilihan_d" value="{{ old('pilihan_d') }}" required>
                    @error('pilihan_d')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <a href="{{ route('admin.kusioner.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
