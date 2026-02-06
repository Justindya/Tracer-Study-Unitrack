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
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>NO</th>
                        <th>Status Akun</th> <th>NIM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnis as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @php
                                    // Ambil status dari tabel users via relasi
                                    // Pastikan model Alumni punya: public function user() { return $this->hasOne(User::class); }
                                    $status = $item->user->status ?? 'unknown'; 
                                @endphp

                                @if($status == 'active')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-secondary">{{ $status }}</span>
                                @endif
                            </td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->program_studi }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{-- Tombol Verifikasi (Hanya muncul jika Pending) --}}
                                    @if($status == 'pending')
                                        {{-- Buat Route baru di web.php: Route::post('/alumni/{id}/verify', ...)->name('admin.alumni.verify') --}}
                                        <form action="{{ route('admin.alumni.verify', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm me-1" title="Verifikasi Akun" onclick="return confirm('Verifikasi akun ini agar bisa login?')">
                                                <i class="fas fa-check"></i> Verif
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('admin.alumni.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.alumni.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.alumni.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{-- Pagination --}}
            <div class="mt-3">
                {{ $alumnis->links() }}
            </div>
        </div>
    </div>
@endsection