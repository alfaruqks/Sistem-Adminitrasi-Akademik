@extends('adminlte::page')

@section('title', 'Tambah Tagihan')

@section('content_header')
    <h1> <i class="fas fa-plus-circle"></i>  Tambah Tagihan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kesiswaan.informasi-tagihan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="murid_id" class="form-label">Pilih Murid</label>
                    <select name="murid_id" class="form-control" required>
                        @foreach(\App\Models\User::where('role', 'murid')->get() as $murid)
                            <option value="{{ $murid->id }}">{{ $murid->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('kesiswaan.informasi-tagihan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop
