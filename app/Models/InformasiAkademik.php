<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiAkademik extends Model
{
    use HasFactory;
    protected $table = 'informasi_akademiks'; // Sesuai dengan nama tabel di database

    protected $fillable = ['judul', 'deskripsi', 'file_pdf'];
}
