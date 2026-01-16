@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Lowongan Kerja</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Lowongan Kerja
            <a href="{{ route('admin.loker.create') }}" class="btn btn-primary float-end">Tambah Lowongan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Perusahaan</th>
                            <th>Lokasi</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lokers as $loker)
                        <tr>
                            <td>{{ $loker->judul }}</td>
                            <td>{{ $loker->perusahaan }}</td>
                            <td>{{ $loker->lokasi }}</td>
                            <td>{{ $loker->tanggal_mulai->format('d/m/Y') }}</td>
                            <td>{{ $loker->tanggal_selesai->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.loker.show', $loker) }}" class="btn btn-info btn-sm">
                                    Lihat
                                </a>
                                <a href="{{ route('admin.loker.edit', $loker) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.loker.destroy', $loker) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $lokers->links() }}
        </div>
    </div>
</div>
@endsection
