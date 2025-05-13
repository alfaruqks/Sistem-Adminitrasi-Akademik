@extends('adminlte::page')

@section('title', 'Profil Saya')

@section('content_header')
    <h1><i class="fas fa-user-tie"></i> Profil Saya</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0"><i class="fas fa-user-circle"></i> Informasi Profil</h3>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                    <div class="form-control bg-light">{{ $name }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-id-card"></i> NIS/NIK </label>
                    <div class="form-control bg-light">{{ $nis }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                    <div class="form-control bg-light">{{ $email }}</div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop
