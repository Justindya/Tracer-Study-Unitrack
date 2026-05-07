@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <h3>Edit Event</h3>
            <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $event->judul }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tema (Opsional)</label>
                    <input type="text" name="tema" class="form-control" value="{{ $event->tema }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tempat</label>
                    <input type="text" name="tempat" class="form-control" value="{{ $event->tempat }}" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $event->tanggal->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai (Opsional)</label>
                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ $event->tanggal_selesai ? $event->tanggal_selesai->format('Y-m-d') : '' }}">
                        <small class="text-muted">Kosongkan jika hanya satu hari.</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jam (Opsional)</label>
                    <input type="time" name="jam" class="form-control" value="{{ $event->jam ? \Carbon\Carbon::parse($event->jam)->format('H:i') : '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Pembicara (Opsional)</label>
                    <input type="text" name="pembicara" class="form-control" value="{{ $event->pembicara }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Event</label>
                        <select name="is_paid" class="form-select" id="is_paid_select" required>
                            <option value="0" {{ !$event->is_paid ? 'selected' : '' }}>Gratis</option>
                            <option value="1" {{ $event->is_paid ? 'selected' : '' }}>Berbayar</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3" id="harga_container" style="{{ $event->is_paid ? 'display: block;' : 'display: none;' }}">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" value="{{ $event->harga }}" min="0">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Poster Event</label>
                    @if($event->poster)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster" style="max-height: 150px;" class="img-thumbnail">
                        </div>
                    @endif
                    <input type="file" name="poster" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah poster.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ $event->deskripsi }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('is_paid_select').addEventListener('change', function() {
            const hargaContainer = document.getElementById('harga_container');
            if (this.value == '1') {
                hargaContainer.style.display = 'block';
            } else {
                hargaContainer.style.display = 'none';
            }
        });
    </script>
@endsection
