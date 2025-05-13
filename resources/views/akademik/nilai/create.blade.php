@extends('adminlte::page')

@section('title', 'Tambah Nilai')

@section('content_header')
    <h1>Tambah Nilai</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('akademik.nilai.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="murid_id">Murid</label>
                    <select name="murid_id" class="form-control" required>
                        <option value="">Pilih Murid</option>
                        @foreach ($murids as $murid)
                            <option value="{{ $murid->id }}">{{ $murid->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" class="form-control" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="role">Jenis Nilai</label>
                    <select name="role" class="form-control" required>
                        <option value="">Pilih Jenis</option>
                        <option value="tugas">Tugas</option>
                        <option value="ujian_tengah">Ujian Tengah</option>
                        <option value="ujian_akhir">Ujian Akhir</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>

                <div class="form-group mt-3">
                    <label for="nilai">Nilai</label>
                    <input type="number" name="nilai" class="form-control" min="0" max="100" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                <a href="{{ route('akademik.nilai.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
        </div>
    </div>
@stop
