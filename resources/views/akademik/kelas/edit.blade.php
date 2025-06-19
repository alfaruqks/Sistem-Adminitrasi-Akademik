@extends('adminlte::page')

@section('title', 'Edit Kelas')

@section('content_header')
    <h1><i class="fas fa-edit"></i> Edit Kelas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('akademik.kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                    @error('nama_kelas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="guru_id">Wali Kelas</label>
                    <select name="guru_id" class="form-control" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}" {{ $kelas->guru_id == $guru->id ? 'selected' : '' }}>
                                {{ $guru->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('guru_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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


                

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary"></i> Simpan</button>
                    <a href="{{ route('akademik.kelas.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@stop
