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

                <div class="form-group mt-3">
                    <label for="murid_id">Pilih Murid</label>
                    <div class="border rounded p-2" style="max-height: 300px; overflow-y: auto;">
                        @foreach($murids as $murid)
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="murid_id[]" 
                                    value="{{ $murid->id }}"id="murid_{{ $murid->id }}"{{ isset($kelas) && $kelas->murids->contains($murid->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="murid_{{ $murid->id }}">
                                    {{ $murid->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <small class="text-muted">Pilih satu atau lebih murid dari daftar.</small>
                    @error('murid_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('akademik.kelas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop
