@extends('layouts.user')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0">Detail Profil Alumni</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        @if ($alumni->Foto)
                            <img src="{{ asset('storage/' . $alumni->Foto) }}" alt="Foto Alumni" class="img-fluid rounded mb-3"
                                style="max-width: 200px;">
                        @else
                            <div class="border rounded p-3 mb-3">
                                <p class="text-muted mb-0">Foto belum tersedia</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped">
                            <tr>
                                <th width="200">Nama Lengkap</th>
                                <td>{{ $alumni->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td>{{ $alumni->nim }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $alumni->email }}</td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>{{ $alumni->no_hp }}</td>
                            </tr>
                            <tr>
                                <th>Angkatan</th>
                                <td>{{ $alumni->angkatan }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Lulus</th>
                                <td>{{ $alumni->tahun_lulus }}</td>
                            </tr>
                            <tr>
                                <th>Program Studi</th>
                                <td>{{ $alumni->program_studi }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ ucfirst($alumni->jenis_kelamin) }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $alumni->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('user.alumni.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('user.alumni.edit', $alumni->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
