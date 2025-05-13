<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\JadwalPelajaran;
use App\Models\InformasiAkademik;
use App\Models\TagihanPembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->role === 'kurikulum') {
            $data = [
                'jumlah_pengguna' => User::count(),
                'jumlah_tagihan' => TagihanPembayaran::count(),
                'jumlah_kelas' => Kelas::count(),
                'jumlah_info' => InformasiAkademik::count(),
            ];
        }

        if ($user->role === 'guru') {
            $data = [
                'jadwal_info' => JadwalPelajaran::count(), 
                'jumlah_info' => InformasiAkademik::count(),
                'jumlah_nilai' => Nilai::count(),
            ];
        }

        if ($user->role === 'murid') {
            $data = [
                'jadwal' => JadwalPelajaran::count(), 
                'nilai' => Nilai::where('murid_id', $user->id)->count(),
                'tagihan' => TagihanPembayaran::where('murid_id', $user->id)->count(),
            ];
        }

        return view('dashboard', compact('data'));
    }
}
