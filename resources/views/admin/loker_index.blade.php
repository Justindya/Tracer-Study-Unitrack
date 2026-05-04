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
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                Daftar Lowongan Kerja
            </div>
            <div>
                <a href="{{ route('admin.loker.create') }}" class="btn btn-primary btn-sm">Tambah Lowongan</a>
            </div>
        </div>
        <div class="card-body">
            <!-- Filter Status -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ $status == 'all' ? 'active' : '' }}" href="{{ route('admin.loker.index', ['status' => 'all']) }}">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $status == 'pending' ? 'active' : '' }}" href="{{ route('admin.loker.index', ['status' => 'pending']) }}">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $status == 'approved' ? 'active' : '' }}" href="{{ route('admin.loker.index', ['status' => 'approved']) }}">Disetujui</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $status == 'rejected' ? 'active' : '' }}" href="{{ route('admin.loker.index', ['status' => 'rejected']) }}">Ditolak</a>
                    </li>
                </ul>
                
                <form action="{{ route('admin.loker.index') }}" method="GET" class="d-flex gap-2">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <select name="jenis" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Jenis Perusahaan</option>
                        <option value="PT" {{ request('jenis') == 'PT' ? 'selected' : '' }}>PT</option>
                        <option value="CV" {{ request('jenis') == 'CV' ? 'selected' : '' }}>CV</option>
                        <option value="Startup" {{ request('jenis') == 'Startup' ? 'selected' : '' }}>Startup</option>
                        <option value="BUMN" {{ request('jenis') == 'BUMN' ? 'selected' : '' }}>BUMN</option>
                    </select>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul & Posisi</th>
                            <th>Perusahaan</th>
                            <th>Lokasi</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lokers as $loker)
                        <tr>
                            <td>{{ $loker->judul }}</td>
                            <td>{{ $loker->perusahaan }}</td>
                            <td>{{ $loker->lokasi }}</td>
                            <td>{{ \Carbon\Carbon::parse($loker->tanggal_selesai)->format('d/m/Y') }}</td>
                            
                            {{-- KOLOM STATUS BARU --}}
                            <td class="text-center">
                                @if($loker->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($loker->status == 'pending')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            
                            <td>
                                {{-- TOMBOL APPROVAL KHUSUS STATUS PENDING --}}
                                @if($loker->status == 'pending')
                                    <form action="{{ route('admin.loker.approve', $loker->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mb-1" onclick="return confirm('Apakah Anda yakin ingin menyetujui lowongan ini?')">
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.loker.reject', $loker->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm mb-1" onclick="return confirm('Tolak lowongan ini?')">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </form>
                                @endif

                                {{-- TOMBOL AKSI STANDAR --}}
                                <a href="{{ route('admin.loker.show', $loker) }}" class="btn btn-info btn-sm mb-1 text-white">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ route('admin.loker.edit', $loker) }}" class="btn btn-warning btn-sm mb-1 text-white">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.loker.destroy', $loker) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $lokers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection