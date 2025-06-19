@extends('adminlte::page')

@section('title', 'Jadwal Pelajaran')

@section('content_header')
    <h1><i class="fas fa-school"></i> Kelas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @if(Auth::user()->role === 'kurikulum')
                <a href="{{ route('akademik.kelas.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah
                </a>
            @endif
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Daftar Murid</th>
                        @if(Auth::user()->role === 'kurikulum')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelas as $index => $data)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $data->nama_kelas }}</td>
                            <td class="text-center">{{ $data->guru->name ?? '-' }}</td>
                            <td class="text-center">
                                    @if(Auth::user()->role === 'kurikulum')
                                        <a href="{{ route('akademik.kelas.show-murid', $data->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-users"></i> Kelola
                                        </a>
                                    @elseif(Auth::user()->role === 'guru')
                                        <a href="{{ route('guru.kelas.show-murid', $data->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-users"></i> Lihat
                                        </a>
                                    @else
                                        <a href="{{ route('murid.kelas.show-murid', $data->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-users"></i> Lihat
                                        </a>
                                    @endif
                            </td>
                            @if(Auth::user()->role === 'kurikulum')
                                <td>
                                    <a href="{{ route('akademik.kelas.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('akademik.kelas.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
