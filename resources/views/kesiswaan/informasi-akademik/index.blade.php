@extends('adminlte::page')

@section('title', 'Informasi Akademik')

@section('content_header')
    <h1> <i class="fas fa-book"></i> Informasi Akademik</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
             @if(Auth::user()->role === 'kurikulum')
            <a href="{{ route('kesiswaan.informasi-akademik.create') }}" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Tambah</a>
             @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Pengumuman</th>
                        @if(auth()->user()->role === 'kurikulum')
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @forelse ($informasi as $info => $i)
                    <tr>
                        <td class="text-center">{{ $info + 1 }}</td>
                        <td class="text-center"><strong>{{ $i->judul }}</strong></td>
                        <td class="text-center">{{ Str::limit($i->deskripsi, 100, '...') }}</td>
                        <td class="text-center">
                            @if ($i->file_pdf)
                                <a href="{{ asset('storage/' . $i->file_pdf) }}" class="btn btn-info btn-sm" target="_blank">
                                    <i class="fas fa-file-pdf"></i> Lihat PDF
                                </a>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </td>
                        @if(auth()->user()->role == 'kurikulum')
                            <td >
                                <a href="{{ route('kesiswaan.informasi-akademik.edit', $i->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('kesiswaan.informasi-akademik.destroy', $i->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada informasi akademik.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

















