@extends('adminlte::page')

@section('title', 'Nilai')

@section('content_header')
    <h1><i class="fas fa-landmark"></i> Nilai</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @if(Auth::user()->role === 'guru')
                <a href="{{ route('akademik.nilai.create') }}" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Tambah </a>
            @endif
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Murid</th>
                        <th>Kelas</th>
                        <th>Jenis Tugas</th>
                        <th>Deskripsi</th>
                        <th>Nilai</th>
                        @if(Auth::user()->role === 'guru')      
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilai as $i => $n)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="text-center">{{ $n->murid->name }}</td>
                            <td class="text-center">{{ $n->kelas->nama_kelas }}</td>
                            <td class="text-center">{{ ucfirst(str_replace('_', ' ', $n->role)) }}</td>
                            <td class="text-center">{{ Str::limit($n->deskripsi, 100, '...') }}</td>
                            <td class="text-center">{{ $n->nilai ?? '-' }}</td>
                            @if(Auth::user()->role === 'guru') 
                                <td>
                                    <a href="{{ route('akademik.nilai.edit', $n->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('akademik.nilai.destroy', $n->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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


































