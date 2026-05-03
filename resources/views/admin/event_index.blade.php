@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Data Event</h3>
            <a class="btn btn-primary btn-sm" href="{{ route('admin.event.create') }}">Tambah Event</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Filter Status -->
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'all' ? 'active' : '' }}" href="{{ route('admin.event.index', ['status' => 'all']) }}">Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'pending' ? 'active' : '' }}" href="{{ route('admin.event.index', ['status' => 'pending']) }}">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'approved' ? 'active' : '' }}" href="{{ route('admin.event.index', ['status' => 'approved']) }}">Disetujui</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'rejected' ? 'active' : '' }}" href="{{ route('admin.event.index', ['status' => 'rejected']) }}">Ditolak</a>
                </li>
            </ul>

            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>NO</th>
                        <th>Judul & Tema</th>
                        <th>Status</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->judul }}</strong><br>
                                <small class="text-muted">{{ $item->tema ?? '-' }}</small>
                            </td>
                            <td>
                                @if($item->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($item->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($item->status == 'pending')
                                    <form action="{{ route('admin.event.approve', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.event.reject', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif

                                    <a href="{{ route('admin.event.show', $item->id) }}" class="btn btn-info text-white" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.event.edit', $item->id) }}" class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.event.destroy', $item->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-dark" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="mt-3">
                {{ $events->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
