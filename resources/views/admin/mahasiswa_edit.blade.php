@extends('layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Data Mahasiswa</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-edit me-1"></i>
                Form Update Mahasiswa
            </div>
            <div class="card-body">
                <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $mahasiswa->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim', $mahasiswa->nim) }}" required>
                            @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                @php $currentJK = $mahasiswa->alumni ? $mahasiswa->alumni->jenis_kelamin : 'laki-laki'; @endphp
                                <option value="laki-laki" {{ old('jenis_kelamin', $currentJK) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin', $currentJK) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $mahasiswa->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Angkatan</label>
                            <input type="text" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror" value="{{ old('angkatan', $mahasiswa->alumni ? $mahasiswa->alumni->angkatan : '') }}" placeholder="Contoh: 2023" required>
                            @error('angkatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Tahun Lulus</label>
                            <input type="text" name="tahun_lulus" class="form-control @error('tahun_lulus') is-invalid @enderror" value="{{ old('tahun_lulus', $mahasiswa->alumni ? $mahasiswa->alumni->tahun_lulus : '-') }}" placeholder="Isi '-' jika belum lulus" required>
                            @error('tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Jurusan</label>
                            <select name="program_studi" class="form-control @error('program_studi') is-invalid @enderror" required>
                                <option value="">Pilih Jurusan</option>
                                @php $currentProdi = $mahasiswa->alumni ? $mahasiswa->alumni->program_studi : ''; @endphp
                                <option value="Sistem Informasi" {{ old('program_studi', $currentProdi) == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                <option value="Bisnis Digital" {{ old('program_studi', $currentProdi) == 'Bisnis Digital' ? 'selected' : '' }}>Bisnis Digital</option>
                                <option value="Gizi" {{ old('program_studi', $currentProdi) == 'Gizi' ? 'selected' : '' }}>Gizi</option>
                            </select>
                            @error('program_studi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password (Kosongkan jika tidak ingin diubah)</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
