@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Soal Kusioner</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Kusioner
            <a href="{{ route('admin.kusioner.create') }}" class="btn btn-primary float-end">Tambah Kusioner</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Soal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kusioners as $kusioner)
                        <tr>
                            <td>{{ $kusioner->soal }}</td>
                            <td>
                                <a href="{{ route('admin.kusioner.show', $kusioner) }}" class="btn btn-info btn-sm">
                                    Lihat Jawaban
                                </a>
                                <a href="{{ route('admin.kusioner.edit', $kusioner) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.kusioner.destroy', $kusioner) }}" method="POST" class="d-inline">
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
            {{ $kusioners->links() }}
        </div>
    </div>
</div>
@endsection
