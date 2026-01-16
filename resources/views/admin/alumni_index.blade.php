@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Data Alumni</h3>
                <div>
                    <a class="btn btn-success me-2" href="{{ route('admin.alumni.export.all') }}">
                        <i class="fas fa-file-excel"></i> Export Semua Alumni
                    </a>
                    <a class="btn btn-primary" href="{{ route('admin.alumni.create') }}">Tambah Alumni</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Jenis Kelamin</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnis as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->program_studi }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>
                                <a href="{{ route('admin.alumni.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('admin.alumni.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.alumni.destroy', $item->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
