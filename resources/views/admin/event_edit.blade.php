@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <h3>Edit Event</h3>
            <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $event->judul }}" required>
                </div>
                <div class="mb-3">
                    <label>Tempat</label>
                    <input type="text" name="tempat" class="form-control" value="{{ $event->tempat }}" required>
                </div>
                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $event->tanggal }}" required>
                </div>
                <div class="mb-3">
                    <label>Jam</label>
                    <input type="time" name="jam" class="form-control" value="{{ $event->jam }}" required>
                </div>
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required>{{ $event->deskripsi }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
