<?php

namespace App\Http\Controllers;

use App\Models\TugasSekolah;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;

class TugasSekolahController extends Controller
{
    public function index()
    {
        $tugas = TugasSekolah::with('jadwalPelajaran', 'kelas')->get();
        return view('akademik.tugas.index', compact('tugas'));
    }

    public function create()
    {
        $jadwal = JadwalPelajaran::with('kelas')->get();
        return view('akademik.tugas.create', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_pelajaran_id' => 'required',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'deadline' => 'required|date',
        ]);

        TugasSekolah::create($request->all());

        return redirect()->route('akademik.tugas.index')->with('success', 'Tugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tugas = TugasSekolah::findOrFail($id);
        $jadwal = JadwalPelajaran::with('kelas')->get();
        return view('akademik.tugas.edit', compact('tugas', 'jadwal'));
    }

    public function update(Request $request, $id)
    {
        $tugas = TugasSekolah::findOrFail($id);
        $tugas->update($request->all());

        return redirect()->route('akademik.tugas.index')->with('success', 'Tugas berhasil diperbarui');
    }

    public function destroy($id)
    {
        TugasSekolah::findOrFail($id)->delete();
        return redirect()->route('akademik.tugas.index')->with('success', 'Tugas berhasil dihapus');
    }
}
