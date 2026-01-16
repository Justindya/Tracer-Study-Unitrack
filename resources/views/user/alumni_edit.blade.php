@extends('layouts.user')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0">Edit Profil Alumni</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('user.alumni.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ $alumni->nama }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim"
                                    value="{{ $alumni->nim }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $alumni->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="{{ $alumni->no_hp }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="angkatan" class="form-label">Angkatan</label>
                                <input type="text" class="form-control" id="angkatan" name="angkatan"
                                    value="{{ $alumni->angkatan }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus"
                                    value="{{ $alumni->tahun_lulus }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Program Studi</label>
                                <select name="program_studi" class="form-control" required>
                                    <option value="DIII - Akutansi"
                                        {{ $alumni->program_studi == 'DIII - Akutansi' ? 'selected' : '' }}>DIII - Akutansi
                                    </option>
                                    <option value="DIII - Teknik Mesin"
                                        {{ $alumni->program_studi == 'DIII - Teknik Mesin' ? 'selected' : '' }}>DIII -
                                        Teknik Mesin</option>
                                    <option value="DIII - Teknik Komputer"
                                        {{ $alumni->program_studi == 'S1 - Teknik Komputer' ? 'selected' : '' }}>S1 -
                                        Teknik Komputer</option>
                                    <option value="DIII - Teknik Elerektronika"
                                        {{ $alumni->program_studi == 'S1 - Teknik Elerektronika' ? 'selected' : '' }}>S1
                                        - Teknik Elerektronika</option>
                                    <option value="DIII - Mekanik Otomotif"
                                        {{ $alumni->program_studi == 'DIII - Mekanik Otomotif' ? 'selected' : '' }}>DIII -
                                        Mekanik Otomotif</option>
                                    <option value="DIII - Alat Berat"
                                        {{ $alumni->program_studi == 'DIII - Alat Berat' ? 'selected' : '' }}>DII - Alat
                                        Berat</option>
                                    <option value="DIII - Teknik Kimia"
                                        {{ $alumni->program_studi == 'DIII - Teknik Kimia' ? 'selected' : '' }}>DII - Teknik
                                        Kimia(industri)</option>
                                    <option value="DIII - Rekam Medik & Informasi Kesehatan"
                                        {{ $alumni->program_studi == 'DIII - Rekam Medik & Informasi Kesehatan' ? 'selected' : '' }}>
                                        DII - Rekam Medik & Informasi Kesehatan</option>
                                    <option value="DIV - Teknik Informatika"
                                        {{ $alumni->program_studi == 'DIV - Teknik Informatika' ? 'selected' : '' }}>DIV -
                                        Teknik Informatika</option>
                                    <option value="DIV - Mekanik Industri Dan Desain"
                                        {{ $alumni->program_studi == 'DIV - Mekanik Industri Dan Desain' ? 'selected' : '' }}>
                                        DIV - Mekanik Industri Dan Desain</option>
                                    <option value="DIV - Mekatronika"
                                        {{ $alumni->program_studi == 'DIV - Mekatronika' ? 'selected' : '' }}>DIV -
                                        Mekatronika</option>
                                    <option value="DIV - Komputer Akutansi"
                                        {{ $alumni->program_studi == 'DIV - Komputer Akutansi' ? 'selected' : '' }}>DIV -
                                        Komputer Akutansi</option>
                                    <option value="DIV - Teknik Otomasi"
                                        {{ $alumni->program_studi == 'DIV - Teknik Otomasi' ? 'selected' : '' }}>DIV -
                                        Teknik Otomasi(industri)</option>
                                    <option value="DIV - Kontruksi Bangunan"
                                        {{ $alumni->program_studi == 'DIV - Kontruksi Bangunan' ? 'selected' : '' }}>DIV -
                                        Kontruksi Bangunan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="laki-laki"
                                        {{ $alumni->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="perempuan"
                                        {{ $alumni->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $alumni->alamat }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="Foto" class="form-label">Foto</label>
                                @if ($alumni->Foto)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $alumni->Foto) }}" alt="Current Photo"
                                            class="img-thumbnail" style="max-width: 150px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="Foto" name="Foto">
                                <small class="text-muted">Leave empty if you don't want to change the photo</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                        <a href="{{ route('user.alumni.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
