@extends('adminlte::page')

@section('title', 'Edit Pengguna')

@section('content_header')
    <h1>Edit Pengguna</h1>
@stop

@section('content')

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
        <form action="{{ route('kesiswaan.tambah-pengguna.update', $users->id) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $users->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>NIS/NIK</label>
                        <input type="text" name="nis" class="form-control" value="{{ old('nis', $users->nis) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email Pengguna</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $users->email) }}" required>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="guru" {{ $users->role == 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="murid" {{ $users->role == 'murid' ? 'selected' : '' }}>Murid</option>
                            <option value="kurikulum" {{ $users->role == 'kurikulum' ? 'selected' : '' }}>Kurikulum</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control text-muted">
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>

            <div class="text-left mt-4">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('kesiswaan.tambah-pengguna.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>


@stop
