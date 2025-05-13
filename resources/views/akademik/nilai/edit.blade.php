@extends('adminlte::page')

@section('title', 'Edit Nilai')

@section('content_header')
    <h1>Edit Nilai</h1>
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

            <form action="{{ route('akademik.nilai.update', $nilai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="murid_id">Murid</label>
                    <select name="murid_id" class="form-control" required>
                        @foreach ($murids as $murid)
                            <option value="{{ $murid->id }}" {{ $nilai->murid_id == $murid->id ? 'selected' : '' }}>
                                {{ $murid->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" class="form-control" required>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ $nilai->kelas_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="role">Jenis Nilai</label>
                    <select name="role" class="form-control" required>
                        <option value="tugas" {{ $nilai->role == 'tugas' ? 'selected' : '' }}>Tugas</option>
                        <option value="ujian_tengah" {{ $nilai->role == 'ujian_tengah' ? 'selected' : '' }}>Ujian Tengah</option>
                        <option value="ujian_akhir" {{ $nilai->role == 'ujian_akhir' ? 'selected' : '' }}>Ujian Akhir</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $nilai->deskripsi }}</textarea>
                </div>

                <div class="form-group mt-3">
                    <label for="nilai">Nilai</label>
                    <input type="number" name="nilai" class="form-control" value="{{ $nilai->nilai }}" min="0" max="100" required>
                </div>

                <button type="submit" class="btn btn-success mt-3">Update</button>
                <a href="{{ route('akademik.nilai.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
        </div>
    </div>
@stop
