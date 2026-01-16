@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="mb-4">
                    <a href="{{ route('user.events.index') }}"
                        class="btn btn-primary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar Event
                    </a>
                </div>

                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $event->judul }}</h1>
                    <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>{{ $event->tanggal->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ $event->jam }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $event->tempat }}</span>
                        </div>
                    </div>
                </div>

                <div class="prose max-w-none">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi Event</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <p class="text-gray-600 whitespace-pre-line">{{ $event->deskripsi }}</p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <p>Dibuat: {{ $event->created_at->format('d M Y, H:i') }}</p>
                            <p>Terakhir diupdate: {{ $event->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
