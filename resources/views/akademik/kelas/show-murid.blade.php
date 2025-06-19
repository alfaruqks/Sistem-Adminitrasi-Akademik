@extends('adminlte::page')

@section('title', 'Daftar Murid Kelas')

@section('content_header')
    <h1><i class="fas fa-users"></i> Daftar Murid Kelas: {{ $kelas->nama_kelas }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @if(Auth::user()->role === 'kurikulum')
            <form action="{{ route('akademik.kelas.tambah-murid', $kelas->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="murid_id" class="form-control" required>
                            <option value="">-- Pilih Murid --</option>
                            @foreach($semuaMurid as $murid)
                                <option value="{{ $murid->id }}">{{ $murid->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus-circle"></i> Tambah
                    </button>
            </form>
            @endif 
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th class="text-center">Nama Murid</th>
                            @if(Auth::user()->role === 'kurikulum')
                                <th width="15%" class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas->murids as $index => $murid)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $murid->name }}</td>
                                @if(Auth::user()->role === 'kurikulum')
                                    <td >
                                        <form action="{{ route('akademik.kelas.hapus-murid', [$kelas->id, $murid->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                           <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->role === 'kurikulum' ? 3 : 2 }}" class="text-center text-muted py-3">
                                    <i class="fas fa-info-circle"></i> Belum ada murid di kelas ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
                <div  >
                    @if(Auth::user()->role === 'kurikulum')
                        <a href="{{ route('akademik.kelas.index') }}" class="btn btn-sm btn-secondary">
                             <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    @elseif(Auth::user()->role === 'guru')
                        <a href="{{ route('guru.kelas.index') }}" class="btn btn-sm btn-secondary">
                             <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    @else
                        <a href="{{ route('murid.kelas.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    @endif

                </div>
                     </div>

        
   
@stop