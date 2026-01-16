@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Event</h1>

                @if ($events->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($events as $event)
                            <div
                                class="bg-white border rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $event->judul }}</h3>
                                    <div class="text-sm text-gray-600 mb-3">
                                        <p class="mb-1">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            {{ $event->tanggal->format('d F Y') }}
                                        </p>
                                        <p class="mb-1">
                                            <i class="fas fa-clock mr-2"></i>
                                            {{ $event->jam }}
                                        </p>
                                        <p>
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            {{ $event->tempat }}
                                        </p>
                                    </div>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($event->deskripsi, 100) }}</p>
                                    <a href="{{ route('user.events.show', $event->id) }}"
                                        class="btn btn-primary">
                                        Detail Event
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $events->links() }}
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-600">Tidak ada event yang tersedia saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
