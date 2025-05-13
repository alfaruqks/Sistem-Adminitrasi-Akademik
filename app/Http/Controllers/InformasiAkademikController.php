<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiAkademik;
use Illuminate\Support\Facades\Storage;

class InformasiAkademikController extends Controller
{
    public function index()
    {
        $informasi = InformasiAkademik::latest()->get();
        return view('kesiswaan.informasi-akademik.index', compact('informasi'));
    }

    public function create()
    {
        return view('kesiswaan.informasi-akademik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'file_pdf' => 'nullable|mimes:pdf|max:2048'
        ]);

        // Simpan file PDF jika ada
        $fileName = $request->file('file_pdf') 
            ? $request->file('file_pdf')->store('pdfs', 'public')
            : null;

        // Simpan ke database
        InformasiAkademik::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_pdf' => $fileName
        ]);

        return redirect()->route('kesiswaan.informasi-akademik.index')
            ->with('success', 'Informasi Akademik berhasil ditambahkan');
    }

    public function show($id)
    {
        $informasi = InformasiAkademik::findOrFail($id);
        return view('kesiswaan.informasi-akademik.show', compact('informasi'));
    }

    public function edit($id)
    {
        $informasi = InformasiAkademik::findOrFail($id);
        return view('kesiswaan.informasi-akademik.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'file_pdf' => 'nullable|mimes:pdf|max:2048'
        ]);

        $informasi = InformasiAkademik::findOrFail($id);

        // Jika ada file baru, hapus yang lama dan simpan yang baru
        if ($request->hasFile('file_pdf')) {
            if ($informasi->file_pdf) {
                Storage::disk('public')->delete($informasi->file_pdf);
            }
            $fileName = $request->file('file_pdf')->store('pdfs', 'public');
        } else {
            $fileName = $informasi->file_pdf;
        }

        // Update data
        $informasi->update($request->only(['judul', 'deskripsi']) + ['file_pdf' => $fileName]);

        return redirect()->route('kesiswaan.informasi-akademik.index')
            ->with('success', 'Informasi Akademik berhasil diperbarui');
    }

    public function destroy($id)
    {
        $informasi = InformasiAkademik::findOrFail($id);
        
        // Hapus file PDF jika ada
        if ($informasi->file_pdf) {
            Storage::disk('public')->delete($informasi->file_pdf);
        }

        // Hapus dari database
        $informasi->delete();

        return redirect()->route('kesiswaan.informasi-akademik.index')->with('success', 'Informasi Akademik berhasil dihapus');
    }
}
