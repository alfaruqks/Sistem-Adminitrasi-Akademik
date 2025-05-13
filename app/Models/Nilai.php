<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'murid_id',
        'kelas_id',
        'role',
        'nilai',
        'deskripsi'
    ];

    public function murid()
    {
        return $this->belongsTo(User::class, 'murid_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
