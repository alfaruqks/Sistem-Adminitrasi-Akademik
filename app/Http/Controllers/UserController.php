<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:kurikulum'); // pastikan middleware 'role' terpasang
    }

    public function index()
    {
        $users = User::all(); // tampilkan semua user
        return view('kesiswaan.tambah-pengguna.index', compact('users'));
    }

    public function create()
    {
        return view('kesiswaan.tambah-pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'nis'      => ['required', 'string', 'max:20', 'unique:users,nis'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'in:guru,murid,kurikulum'],
        ]);

        User::create([
            'name'     => $request->name,
            'nis'      => $request->nis,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);



        return redirect()->route('kesiswaan.tambah-pengguna.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('kesiswaan.tambah-pengguna.edit', compact('users'));
    }

    public function update(Request $request, $id)
{
    $users = User::findOrFail($id);

    $request->validate([
        'name'     => ['required', 'string', 'max:255'],
        'nis'      => ['required', 'string', 'max:20', 'unique:users,nis,' . $id],
        'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
        'role'     => ['required', 'in:guru,murid,kurikulum'],
        'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
    ]);

    $users->name = $request->name;
    $users->nis = $request->nis;
    $users->email = $request->email;
    $users->role = $request->role;

    if ($request->filled('password')) {
        $users->password = Hash::make($request->password);
    }

    $users->save();

    return redirect()->route('kesiswaan.tambah-pengguna.index')->with('success', 'User berhasil diupdate!');
}


    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect()->route('kesiswaan.tambah-pengguna.index')->with('success', 'User berhasil dihapus!');
    }
}
