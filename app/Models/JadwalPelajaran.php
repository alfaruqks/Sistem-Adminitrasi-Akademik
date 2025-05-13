<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    use HasFactory;
    protected $table = 'jadwal_pelajaran'; // Sesuai dengan nama tabel di database
    protected $fillable = ['kelas_id', 'hari', 'jam_mulai', 'jam_selesai', 'mata_pelajaran'];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    
}
