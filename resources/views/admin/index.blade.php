@extends('mylayout', ['title' => 'Tracer Study Admin'])
@section('content')
    <div class="card">
        halo, saya berada di file alumni_index.blade.php
        <h1>Saya sedang belajar MVC-R</h1>
        <a href="{{ route('alumni.create') }}" class="btn btn-primary">Tambah Alumni</a>
    </div>
@endsection
