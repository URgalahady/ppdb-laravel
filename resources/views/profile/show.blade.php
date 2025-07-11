@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Data Pribadi</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Nama:</strong>
                        <p class="lead">{{ $user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p class="lead">{{ $user->email }}</p>
                    </div>
                    <div class="mb-4">
                        @if ($isRegistered)
                            <div class="alert alert-success" role="alert">
                                Status: <strong>Anda sudah mendaftar.</strong>
                            </div>
                           
                        @else
                            <div class="alert alert-warning" role="alert">
                                Status: <strong>Anda belum mendaftar.</strong>
                                <br>
                                <a href="{{ route('form.create') }}" class="btn btn-primary mt-3">Klik di sini untuk melengkapi form pendaftaran</a>
                                 <a href="{{ route('formulir.tracking') }}" class="btn btn-info mt-3">Lihat Status Pendaftaran</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
