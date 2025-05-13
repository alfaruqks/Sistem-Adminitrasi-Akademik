@extends('adminlte::page')

@section('title', 'Tambah Pengguna')

@section('content_header')
    <h1>Tambah Pengguna</h1>
@stop

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<div class="card">
{{-- Menampilkan pesan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan saat input data:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <div class="card-body">
        <form action="{{ route('kesiswaan.tambah-pengguna.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="form-group">
                        <label>Email Pengguna</label>
                        <input type="email" name="email" class="form-control" required placeholder="Masukkan email pengguna">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>NIS/NIK</label>
                        <input type="text" name="nis" class="form-control" required placeholder="Masukkan NIS/NIK">
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Konfirmasi password">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="guru">Guru</option>
                            <option value="murid">Murid</option>
                            <option value="kurikulum">Kurikulum</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group text-left">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kesiswaan.tambah-pengguna.index') }}" class="btn btn-secondary">Kembali</a>

            </div>

            
        </form>
    </div>
</div>

@stop
