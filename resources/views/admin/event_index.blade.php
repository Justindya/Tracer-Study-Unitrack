@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    
    @if(session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-calendar-alt me-1"></i>
            Data Event
            <a class="btn btn-primary float-end" href="{{ route('admin.event.create') }}">Tambah Event</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>NO</th>
                            <th>Judul</th>
                            <th>Tempat</th>
                            <th>Status</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->tempat }}</td>
                                
                                {{-- KOLOM STATUS BARU --}}
                                <td class="text-center">
                                    @if($item->status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($item->status == 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                
                                <td>
                                    {{-- TOMBOL APPROVAL KHUSUS STATUS PENDING --}}
                                    @if($item->status == 'pending')
                                        <form action="{{ route('admin.event.approve', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm mb-1" onclick="return confirm('Setujui event ini?')">Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.event.reject', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-sm mb-1" onclick="return confirm('Tolak event ini?')">Tolak</button>
                                        </form>
                                    @endif

                                    {{-- TOMBOL AKSI STANDAR --}}
                                    <a href="{{ route('admin.event.show', $item->id) }}" class="btn btn-info btn-sm mb-1 text-white">Detail</a>
                                    <a href="{{ route('admin.event.edit', $item->id) }}" class="btn btn-warning btn-sm mb-1 text-white">Edit</a>
                                    <form action="{{ route('admin.event.destroy', $item->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mb-1">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data event.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</div>
@endsection