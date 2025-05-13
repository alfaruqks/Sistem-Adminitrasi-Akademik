@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <h3>Selamat Datang, {{Auth::user()->name}}</h3>
@stop

@section('content')
    <div class="row">
            {{-- Jika role Kurikulum --}}
            @if (Auth::user()->role === 'kurikulum')
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-olive">
                        <div class="inner">
                            <h3>{{ $data['jumlah_pengguna'] ?? 0 }}</h3>
                            <p>Jumlah Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <a href="{{ route('kesiswaan.tambah-pengguna.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-info">
                        <div class="inner">
                            <h3>{{ $data['jumlah_tagihan'] ?? 0 }}</h3>
                            <p>Jumlah Tagihan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <a href="{{ route('kesiswaan.informasi-tagihan.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-warning">
                        <div class="inner">
                            <h3>{{ $data['jumlah_kelas'] ?? 0 }}</h3>
                            <p>Kelas Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <a href="{{ route('akademik.kelas.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-orange">
                        <div class="inner">
                            <h3>{{ $data['jumlah_info'] ?? 0 }}</h3>
                            <p>Informasi Akademik</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <a href="{{ route('kesiswaan.informasi-akademik.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endif

            {{-- Jika role Guru --}}
            @if (Auth::user()->role === 'guru')
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-orange">
                        <div class="inner">
                            <h3>{{ $data['jadwal_info'] ?? 0  }}</h3>
                            <p>Jadwal Mengajar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="{{ route('guru.jadwal.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-primary">
                        <div class="inner">
                            <h3>{{ $data['jumlah_info'] ?? 0 }}</h3>
                            <p>Informasi Akademik</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="{{ route('guru.informasi-akademik.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-teal">
                        <div class="inner">
                            <h3>{{ $data['jumlah_nilai'] ?? 0 }}</h3>
                            <p>Input Nilai</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-pen"></i>
                        </div>
                        <a href="{{ route('akademik.nilai.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endif

            {{-- Jika role Murid --}}
            @if (Auth::user()->role === 'murid')
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-purple">
                        <div class="inner">
                            <h3>{{ $data['jadwal'] ?? 0 }}</h3>
                            <p>Jadwal Pelajaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="{{ route('murid.jadwal.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-pink">
                        <div class="inner">
                            <h3>{{ $data['nilai'] ?? 0 }}</h3>
                            <p>Hasil Tugas dan Ujian</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <a href="{{ route('murid.nilai.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-gradient-yellow">
                        <div class="inner">
                            <h3>{{ $data['tagihan'] ?? 0 }}</h3>
                            <p>Tagihan Pembayaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <a href="{{ route('murid.kesiswaan.informasi-tagihan.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
@stop

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>
    <strong>
        Copyright &copy; {{ date('Y') }}
        <a href="{{ config('app.company_url', 'dashboard') }}">{{ config('app.company_name', 'SDIT ASA') }}</a>.
    </strong> All rights reserved.
@stop

@section('css')
    {{-- Tambahkan CSS tambahan jika dibutuhkan --}}
@stop

@section('js')
    <script> console.log('Dashboard Loaded'); </script>
@stop
