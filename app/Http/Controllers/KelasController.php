<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /** List kelas */
    public function index()
    {
        $user = Auth::user();

        // Murid hanya lihat kelasnya sendiri
        if ($user->role === 'murid') {
            $kelas = Kelas::with('guru', 'murids') ->whereHas('murids', fn ($q) => $q->where('murid_id', $user->id))->get();
        } else {
            // Guru & kurikulum lihat semua kelas
            $kelas = Kelas::with('guru', 'murids')->get();
        }

        return view('akademik.kelas.index', compact('kelas'));
    }

    // form daftar nama murid 
    public function showMurid($kelasId)
    {
        
        $kelas = Kelas::with('murids')->findOrFail($kelasId);
        if (auth()->user()->role === 'murid' && !$kelas->murids->contains(auth()->id())) {
        abort(403);
    }
        
        // Ambil murid yang belum terdaftar di kelas ini
        $semuaMurid = User::where('role', 'murid')->whereDoesntHave('kelas', function($q) use ($kelasId) {$q->where('kelas_id', $kelasId);})->get();
        
        $view = match(auth()->user()->role) {
        'kurikulum' => 'akademik.kelas.show-murid',
        'guru' => 'guru.kelas.show-murid',
        'murid' => 'murid.kelas.show-murid',
        default => 'akademik.kelas.show-murid'};   

                    

        return view('akademik.kelas.show-murid', compact('kelas', 'semuaMurid'));
    }

    // Tambah murid ke kelas
    public function tambahMurid(Request $request, $kelasId)
    {
        $request->validate(['murid_id' => 'required|exists:users,id']);
        
        $kelas = Kelas::findOrFail($kelasId);
        $kelas->murids()->attach($request->murid_id);
        
        return redirect()->back()->with('success', 'Murid berhasil ditambahkan');
    }

    // Hapus murid dari kelas
    public function hapusMurid($kelasId, $muridId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $kelas->murids()->detach($muridId);
        
        return redirect()->back()->with('success', 'Murid berhasil dihapus dari kelas');
    }

    /** Form create */
    public function create(Request $request)
    {
        $gurus  = User::where('role', 'guru')->get();
        $murids = User::where('role', 'murid')->get();
        return view('akademik.kelas.create', compact('gurus', 'murids'));
    }

    /** Simpan kelas + banyak murid */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'guru_id'    => 'required|exists:users,id',
            'murid_id'   => 'required|array|min:1',
            'murid_id.*' => 'exists:users,id',
        ]);

        // buat kelas
        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'guru_id'    => $request->guru_id,
        ]);

        // attach murid ke pivot
        $kelas->murids()->attach($request->murid_id);

        return redirect()->route('akademik.kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    /** Form edit */
    public function edit($id)
    {
        $kelas  = Kelas::with('murids')->findOrFail($id);
        $gurus  = User::where('role', 'guru')->get();
        $murids = User::where('role', 'murid')->get();
        return view('akademik.kelas.edit', compact('kelas', 'gurus', 'murids'));
    }

    /** Update kelas + sinkron murid */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'guru_id'    => 'required|exists:users,id',
            'murid_id'   => 'required|array|min:1',
            'murid_id.*' => 'exists:users,id',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'guru_id'    => $request->guru_id,
        ]);

        // sinkron murid di pivot
        $kelas->murids()->sync($request->murid_id);

        return redirect()->route('akademik.kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    /** Hapus kelas & pivot */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->murids()->detach();   // hapus relasi murid
        $kelas->delete();

        return redirect()->route('akademik.kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}
