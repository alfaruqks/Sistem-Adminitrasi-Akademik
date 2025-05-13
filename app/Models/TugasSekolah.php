<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasSekolah extends Model
{
    use HasFactory;
    protected $table = 'tugas_sekolah';
    protected $fillable = ['jadwal_pelajaran_id', 'kelas_id', 'judul', 'deskripsi', 'deadline'];

    public function jadwalPelajaran()
    {
        return $this->belongsTo(JadwalPelajaran::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function murid()
    {
        return $this->hasManyThrough(User::class, Kelas::class, 'id', 'kelas_id');
    }
}

