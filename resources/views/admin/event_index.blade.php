@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <h3>Data Event</h3>
            <table class="table table-striped">
                <a class="btn btn-primary mb-3 mt-3" href="{{ route('admin.event.create') }}">Tambah Event</a>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Judul</th>
                        <th>Tempat</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->tempat }}</td>
                            <td>
                                <a href="{{ route('admin.event.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('admin.event.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.event.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
