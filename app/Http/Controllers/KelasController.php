<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'murid') {
            // Hanya menampilkan kelas di mana murid tersebut terdaftar
            $kelas = Kelas::with('guru', 'murid')->where('murid_id', $user->id)->get();
        } else {
            // Guru dan kurikulum bisa melihat semua kelas
            $kelas = Kelas::with('guru', 'murid')->get();
        }

        return view('akademik.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $gurus = User::where('role', 'guru')->get();
        $murids = User::where('role', 'murid')->get();
        return view('akademik.kelas.create', compact('gurus', 'murids'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'guru_id' => 'required|exists:users,id',
            'murid_id' => 'required|exists:users,id',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'guru_id' => $request->guru_id,
            'murid_id' => $request->murid_id,
        ]);

        return redirect()->route('akademik.kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelas = Kelas::with('murid')->findOrFail($id);
        $gurus = User::where('role', 'guru')->get();
        $murids = User::where('role', 'murid')->get();
        return view('akademik.kelas.edit', compact('kelas', 'gurus', 'murids'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'guru_id' => 'required|exists:users,id',
            'murid_id' => 'required|exists:users,id',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'guru_id' => $request->guru_id,
            'murid_id' => $request->murid_id,
        ]);

        return redirect()->route('akademik.kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();
        return redirect()->route('akademik.kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}
