@extends('adminlte::page')

@section('title', 'Informasi Tagihan')

@section('content_header')
    <h1><i class="fas fa-coins"></i> Informasi Tagihan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tagihan as $key => $t)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $t->judul }}</td>
                            <td>Rp{{ number_format($t->jumlah, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $t->status == 'Lunas' ? 'success' : 'warning' }}">
                                    {{ $t->status }}
                                </span>
                            </td>
                            <td>
                                @if(!$t->bukti_pembayaran)
                                    <form action="{{ route('murid.kesiswaan.informasi-tagihan.upload', $t->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="bukti_pembayaran" class="form-control mb-2" required>
                                        <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                                    </form>
                                @else
                                    <a href="{{ asset('storage/'.$t->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
