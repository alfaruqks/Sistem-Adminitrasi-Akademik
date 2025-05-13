@extends('adminlte::page')

@section('title', 'Tambah Kelas')

@section('content_header')
    <h1><i class="fas fa-plus-circle"></i> Tambah Kelas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('akademik.kelas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas') }}" required>
                </div>

                <div class="form-group">
                    <label for="guru_id">Wali Kelas</label>
                    <select name="guru_id" class="form-control" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="murid_id">Murid</label>
                    <select name="murid_id" class="form-control" required>
                        <option value="">-- Pilih Murid --</option>
                        @foreach($murids as $murid)
                            <option value="{{ $murid->id }}">{{ $murid->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('akademik.kelas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop
