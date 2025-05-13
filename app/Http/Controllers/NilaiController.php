<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'murid') {
            // Murid hanya melihat nilainya sendiri
            $nilai = Nilai::with('murid', 'kelas')
                        ->where('murid_id', $user->id)
                        ->get();
        } else {
            // Guru dan kurikulum melihat semua nilai
            $nilai = Nilai::with('murid', 'kelas')->get();
        }

        return view('akademik.nilai.index', compact('nilai'));
    }

    public function create()
    {
        $murids = User::where('role', 'murid')->get();
        $kelas = Kelas::all();
        return view('akademik.nilai.create', compact('murids', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'murid_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
            'role' => 'required|in:tugas,ujian_akhir,ujian_tengah',
            'deskripsi' => 'required',
            'nilai' => 'nullable|integer|min:0|max:100',
        ]);

        Nilai::create($request->all());
        return redirect()->route('akademik.nilai.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $murids = User::where('role', 'murid')->get();
        $kelas = Kelas::all();
        return view('akademik.nilai.edit', compact('nilai', 'murids', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'murid_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
            'role' => 'required|in:tugas,ujian_akhir,ujian_tengah',
            'deskripsi' => 'required',
            'nilai' => 'nullable|integer|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($request->all());
        return redirect()->route('akademik.nilai.index')->with('success', 'Nilai berhasil diperbarui');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        return redirect()->route('akademik.nilai.index')->with('success', 'Nilai berhasil dihapus');
    }
}
