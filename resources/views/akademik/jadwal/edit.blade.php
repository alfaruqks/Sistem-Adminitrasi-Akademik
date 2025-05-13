@extends('adminlte::page')

@section('title', 'Edit Jadwal')

@section('content_header')
    <h1>Edit Jadwal Pelajaran</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
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

            <form action="{{ route('akademik.jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <input type="text" name="mata_pelajaran" class="form-control" value="{{ old('mata_pelajaran', $jadwal->mata_pelajaran) }}" required>
                </div>

                <div class="form-group">
                    <label>Kelas</label>
                    <select name="kelas_id" class="form-control" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}" {{ old('kelas_id', $jadwal->kelas_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Hari</label>
                    <select name="hari" class="form-control" required>
                        @php
                            $hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                        @endphp
                        @foreach ($hari_list as $hari)
                            <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                                {{ $hari }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}" required>
                </div>

                <div class="form-group">
                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('akademik.jadwal.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop
