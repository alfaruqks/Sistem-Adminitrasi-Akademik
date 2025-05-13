<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;


class JadwalPelajaranController extends Controller
{
    public function index() {
        $jadwal = JadwalPelajaran::with('kelas')->get();
        return view('akademik.jadwal.index', compact('jadwal'));
    }
    public function create() {
        $kelas = Kelas::all();
        return view('akademik.jadwal.create', compact('kelas'));
    }
    public function store(Request $request) {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id', 
            'hari' => 'required|string', 
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'mata_pelajaran' => 'required|string'
        ]);
    
        JadwalPelajaran::create($request->all());
        return redirect()->route('akademik.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }
    
    public function edit($id) {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $kelas = Kelas::all();
        return view('akademik.jadwal.edit', compact('jadwal', 'kelas'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'mata_pelajaran' => 'required|string'
        ]);
    
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->update($request->all());
        return redirect()->route('akademik.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }
    public function destroy($id) {
        JadwalPelajaran::findOrFail($id)->delete();
        return redirect()->route('akademik.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
    
}