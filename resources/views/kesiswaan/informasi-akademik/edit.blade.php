@extends('adminlte::page')

@section('title', 'Edit Informasi Akademik')

@section('content_header')
    <h1>Edit Informasi Akademik</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kesiswaan.informasi-akademik.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $informasi->judul }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $informasi->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="file_pdf" class="form-label">Upload PDF</label>
                    <input type="file" class="form-control" id="file_pdf" name="file_pdf" accept="application/pdf">
                    @if($informasi->file_pdf)
                        <p>File saat ini: <a href="{{ asset('storage/'.$informasi->file_pdf) }}" target="_blank">Lihat PDF</a></p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('kesiswaan.informasi-akademik.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@stop
