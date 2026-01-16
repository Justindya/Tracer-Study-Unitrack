@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Isi Kusioner Alumni</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('user.kusioner.store') }}" method="POST">
                            @csrf
                            @foreach ($kusioners as $kusioner)
                                <div class="mb-4">
                                    <label class="form-label"><strong>{{ $loop->iteration }}.
                                            {{ $kusioner->soal }}</strong></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban[{{ $kusioner->id }}]"
                                            id="{{ $kusioner->id }}_a" value="{{ $kusioner->pilihan_a }}" required>
                                        <label class="form-check-label" for="{{ $kusioner->id }}_a">
                                            {{ $kusioner->pilihan_a }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban[{{ $kusioner->id }}]"
                                            id="{{ $kusioner->id }}_b" value="{{ $kusioner->pilihan_b }}">
                                        <label class="form-check-label" for="{{ $kusioner->id }}_b">
                                            {{ $kusioner->pilihan_b }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban[{{ $kusioner->id }}]"
                                            id="{{ $kusioner->id }}_c" value="{{ $kusioner->pilihan_c }}">
                                        <label class="form-check-label" for="{{ $kusioner->id }}_c">
                                            {{ $kusioner->pilihan_c }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban[{{ $kusioner->id }}]"
                                            id="{{ $kusioner->id }}_d" value="{{ $kusioner->pilihan_d }}">
                                        <label class="form-check-label" for="{{ $kusioner->id }}_d">
                                            {{ $kusioner->pilihan_d }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-success">Kirim Jawaban</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
