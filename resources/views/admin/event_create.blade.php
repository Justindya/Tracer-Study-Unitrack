@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <h3>Membuat Event</h3>
            <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul event" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tema (Opsional)</label>
                    <input type="text" name="tema" class="form-control" placeholder="Masukkan tema event">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tempat</label>
                    <input type="text" name="tempat" class="form-control" placeholder="Masukkan tempat event" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai (Opsional)</label>
                        <input type="date" name="tanggal_selesai" class="form-control">
                        <small class="text-muted">Kosongkan jika hanya satu hari.</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jam (Opsional)</label>
                    <input type="time" name="jam" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Pembicara (Opsional)</label>
                    <input type="text" name="pembicara" class="form-control" placeholder="Masukkan nama pembicara">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Event</label>
                        <select name="is_paid" class="form-select" id="is_paid_select" required>
                            <option value="0">Gratis</option>
                            <option value="1">Berbayar</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3" id="harga_container" style="display: none;">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" placeholder="0" min="0" value="0">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Poster Event</label>
                    <input type="file" name="poster" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required placeholder="Masukkan deskripsi event"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
