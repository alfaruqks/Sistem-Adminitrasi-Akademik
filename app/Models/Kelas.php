<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas'; // Sesuai dengan nama tabel di database
    protected $fillable = ['nama_kelas','guru_id'];
    
     public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function murids()
    {
        return $this->belongsToMany(
            User::class,
            'kelas_murid',
            'kelas_id',
            'murid_id'
        );
    }
}
