@extends('adminlte::page')

@section('title', 'Jadwal Pelajaran')

@section('content_header')
    <h1><i class="fas fa-calendar"></i> Jadwal Pelajaran</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @if(Auth::user()->role === 'kurikulum')
                <a href="{{ route('akademik.jadwal.create') }}" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Tambah</a>
            @endif
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered table-striped">
                <thead >
                    <tr class="text-center">
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Hari</th>
                        <th>Jam</th>
                    @if(Auth::user()->role === 'kurikulum')      
                        <th>Aksi</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $index => $data)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $data->mata_pelajaran }}</td>
                            <td class="text-center">{{ $data->kelas->nama_kelas ?? 'Tidak ada kelas' }}</td>
                            <td class="text-center">{{ $data->hari }}</td>
                            <td class="text-center">{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                            <td>
                            @if(Auth::user()->role === 'kurikulum') 
                                <a href="{{ route('akademik.jadwal.edit', $data->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('akademik.jadwal.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
