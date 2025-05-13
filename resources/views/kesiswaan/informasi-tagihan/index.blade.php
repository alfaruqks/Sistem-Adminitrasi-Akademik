@extends('adminlte::page')

@section('title', 'Tagihan & Pembayaran')

@section('content_header')
    <h1 ><i class="fas fa-coins"></i> Tagihan & Pembayaran</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('kesiswaan.informasi-tagihan.create') }}" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Murid</th>
                        <th>Judul</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Bukti Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tagihan as $key => $t)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $t->murid->name }}</td>
                            <td class="text-center">{{ $t->judul }}</td>
                            <td class="text-center">Rp{{ number_format($t->jumlah, 2) }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $t->status == 'Lunas' ? 'success' : 'warning' }}">
                                    {{ $t->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($t->bukti_pembayaran)
                                    <a href="{{ asset('storage/'.$t->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                @else
                                    <span class="text-danger">Belum ada</span>
                                @endif
                            </td>
                            <td>
                            <form action="{{ route('kesiswaan.informasi-tagihan.update', $t->id) }}" method="POST"> 
                                @csrf
                                @method('PATCH')
                            </form>
                            <a href="{{ route('kesiswaan.informasi-tagihan.edit', $t->id) }}" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i> Edit</a>
                             <form action="{{ route('kesiswaan.informasi-tagihan.destroy', $t->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus tagihan ini?')"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                           
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
