@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Kusioner</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Form Edit Kusioner
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kusioner.update', $kusioner) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="soal" class="form-label">Soal :</label>
                    <input type="text" class="form-control @error('soal') is-invalid @enderror"
                           id="soal" name="soal" value="{{ old('soal', $kusioner->soal) }}" required>
                    @error('soal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pilihan_a" class="form-label">Pilihan A</label>
                    <input type="text" class="form-control @error('pilihan_a') is-invalid @enderror"
                           id="pilihan_a" name="pilihan_a" value="{{ old('pilihan_a', $kusioner->pilihan_a) }}" required>
                    @error('pilihan_a')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pilihan_b" class="form-label">Pilihan B</label>
                    <input type="text" class="form-control @error('pilihan_b') is-invalid @enderror"
                           id="pilihan_b" name="pilihan_b" value="{{ old('pilihan_b', $kusioner->pilihan_b) }}" required>
                    @error('pilihan_b')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pilihan_c" class="form-label">Pilihan C</label>
                    <input type="text" class="form-control @error('pilihan_c') is-invalid @enderror"
                           id="pilihan_c" name="pilihan_c" value="{{ old('pilihan_c', $kusioner->pilihan_c) }}" required>
                    @error('pilihan_c')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pilihan_d" class="form-label">Pilihan D</label>
                    <input type="text" class="form-control @error('pilihan_d') is-invalid @enderror"
                           id="pilihan_d" name="pilihan_d" value="{{ old('pilihan_d', $kusioner->pilihan_d) }}" required>
                    @error('pilihan_d')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                    <input type="text" class="form-control @error('jawaban_benar') is-invalid @enderror"
                           id="jawaban_benar" name="jawaban_benar" value="{{ old('jawaban_benar', $kuosioner->jawaban_benar) }}" required>
                    @error('jawaban_benar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="mb-3">
                    <a href="{{ route('admin.kusioner.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
