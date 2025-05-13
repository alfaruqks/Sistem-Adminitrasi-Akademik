@extends('adminlte::page')

@section('title', 'Manajemen Pengguna')

@section('content_header')
    <h1 ><i class="fas fa-users"></i> Manajemen Pengguna</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('kesiswaan.tambah-pengguna.create') }}" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered  table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS/NIK</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach($users as $index => $u)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $u->name }}</td>
                            <td class="text-center">{{ $u->nis }}</td>
                            <td class="text-center">{{ $u->email }}</td>
                            <td class="text-center">{{ ucfirst($u->role) }}</td>
                            <td>
                            <form action="{{ route('kesiswaan.tambah-pengguna.update', $u->id) }}" method="POST"> 
                                @csrf
                                @method('PATCH')
                            </form>
                            <a href="{{ route('kesiswaan.tambah-pengguna.edit', $u->id) }}" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('kesiswaan.tambah-pengguna.destroy', $u->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pengguna ini?')"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                           
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop






























