@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <h3 class="mb-4">Register Alumni</h3>
            <form action="{{ route('admin.alumni.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Angkatan</label>
                    <input type="text" name="angkatan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tahun Lulus</label>
                    <input type="text" name="tahun_lulus" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Program Studi</label>
                    <select name="program_studi" class="form-control" required>
                        <option value="DIII - Akutansi">DIII - Akutansi</option>
                        <option value="DIII - Teknik Mesin">DIII - Teknik Mesin</option>
                        <option value="S1 - Teknik Komputer">S1 - Teknik Komputer</option>
                        <option value="S1 - Teknik Elerektronika">S1 - Teknik Elerektronika</option>
                        <option value="DIII - Mekanik Otomotif">DIII - Mekanik Otomotif</option>
                        <option value="DIII - Alat Berat">DIII - Alat Berat</option>
                        <option value="DIII - Teknik Kimia">DIII - Teknik Kimia(industri)</option>
                        <option value="DIII - Rekam Medik & Informasi Kesehatan">DIII - Rekam Medik & Informasi Kesehatan
                        </option>
                        <option value="S1 - Teknik Informatika">DIV - Teknik Informatika</option>
                        <option value="DIV - Mekanik Industri Dan Desain">DIV - Mekanik Industri Dan Desain</option>
                        <option value="DIV - Mekatronika">DIV - Mekatronika</option>
                        <option value="DIV - Komputer Akutansi">DIV - Komputer Akutansi</option>
                        <option value="DIV - Teknik Otomasi">DIV - Teknik Otomasi(industri)</option>
                        <option value="DIV - Kontruksi Bangunan">DIV - Kontruksi Bangunan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Foto</label>
                    <input type="file" name="Foto" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
