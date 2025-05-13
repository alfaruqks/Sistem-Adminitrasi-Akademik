@extends('adminlte::page')

@section('title', 'Edit Tagihan')

@section('content_header')
    <h1>Edit Tagihan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kesiswaan.informasi-tagihan.update', $tagihan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $tagihan->judul }}" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ $tagihan->jumlah }}" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="Belum Lunas" {{ $tagihan->status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="Lunas" {{ $tagihan->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('kesiswaan.informasi-tagihan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop
