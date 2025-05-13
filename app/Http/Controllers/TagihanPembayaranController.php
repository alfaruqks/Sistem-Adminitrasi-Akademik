<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TagihanPembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TagihanPembayaranController extends Controller
{
    // Menampilkan daftar tagihan untuk Kurikulum
    public function index()
    {
        $tagihan = TagihanPembayaran::all();
        return view('kesiswaan.informasi-tagihan.index', compact('tagihan'));
    }

    // Form Tambah Tagihan
    public function create()
    {
        return view('kesiswaan.informasi-tagihan.create');
    }

    // Menyimpan Tagihan Baru
    public function store(Request $request)
    {
        $request->validate([
            'murid_id' => 'required|exists:users,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|numeric|min:0',
        ]);

        TagihanPembayaran::create([
            'murid_id' => $request->murid_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'status' => 'Belum Lunas',
        ]);

        return redirect()->route('kesiswaan.informasi-tagihan.index')->with('success', 'Tagihan berhasil ditambahkan.');
    }

    // Form Edit Tagihan
    public function edit($id)
    {
        $tagihan = TagihanPembayaran::findOrFail($id);
        return view('kesiswaan.informasi-tagihan.edit', compact('tagihan'));
    }

    // Update Tagihan
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|numeric|min:0',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $tagihan = TagihanPembayaran::findOrFail($id);
        $tagihan->update($request->all());

        return redirect()->route('kesiswaan.informasi-tagihan.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    // Hapus Tagihan
    public function destroy($id)
    {
        TagihanPembayaran::destroy($id);
        return redirect()->route('kesiswaan.informasi-tagihan.index')->with('success', 'Tagihan berhasil dihapus.');
    }

    // Menampilkan daftar tagihan untuk Murid
    public function indexMurid()
    {
        $tagihan = TagihanPembayaran::where('murid_id', auth()->user()->id)->get();
        return view('murid.kesiswaan.informasi-tagihan.index', compact('tagihan'));
    }

    // Murid Mengupload Bukti Pembayaran
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|mimes:jpg,png|max:2048',
        ]);

        $tagihan = TagihanPembayaran::findOrFail($id);

        if ($request->hasFile('bukti_pembayaran')) {
            $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $tagihan->update([
                'bukti_pembayaran' => $filePath,
                'status' => 'Lunas',
            ]);
        }

        return redirect()->route('murid.kesiswaan.informasi-tagihan.index')->with('success', 'Bukti pembayaran berhasil diupload.');
    }

}
