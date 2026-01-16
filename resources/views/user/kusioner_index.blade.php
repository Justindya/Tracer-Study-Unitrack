@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Kusioner Alumni</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Soal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kusioners as $kusioner)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $kusioner->soal }}</td>
                                                <td>
                                                    <a href="{{ route('user.kusioner.create', $kusioner->id) }}"
                                                        class="btn btn-primary">Isi Jawaban</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($kusioners->isEmpty())
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada kusioner yang tersedia.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
