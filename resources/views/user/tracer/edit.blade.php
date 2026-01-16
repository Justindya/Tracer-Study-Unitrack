@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Data Tracer</h1>
        <form action="{{ route('user.tracer.update', $tracer->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('user.tracer.form')
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user.tracer.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
