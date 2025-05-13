<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas'; // Sesuai dengan nama tabel di database
    protected $fillable = ['nama_kelas','murid_id','guru_id'];
    
    public function murid()
    {
        return $this->belongsTo(User::class, 'murid_id');
    }

    Public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id'); // Relasi guru_id ke user
    }
}
