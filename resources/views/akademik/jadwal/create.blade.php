@extends('adminlte::page')

@section('title', 'Tambah Jadwal')

@section('content_header')
    <h1>Tambah Jadwal Pelajaran</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('akademik.jadwal.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <input type="text" name="mata_pelajaran" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select name="kelas_id" class="form-control" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Hari</label>
                    <select name="hari" class="form-control" required>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('akademik.jadwal.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop
