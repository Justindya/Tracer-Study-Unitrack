@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-4xl mx-auto px-4">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Update Tracer Alumni</h1>
            <p class="text-gray-500">Perbarui status karir Anda saat ini untuk data alumni.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('user.tracer.store') }}" method="POST">
                @csrf
                
                @include('user.tracer.form')

                <div class="mt-8 flex gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition shadow-md shadow-blue-200 focus:outline-none focus:ring-0 flex items-center gap-2">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                    <a href="{{ route('dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2.5 rounded-xl font-bold text-sm transition focus:outline-none focus:ring-0">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection