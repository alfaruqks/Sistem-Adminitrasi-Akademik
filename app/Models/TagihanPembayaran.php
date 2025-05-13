<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanPembayaran extends Model
{
    use HasFactory;

    protected $table = 'tagihan_pembayaran';

    protected $fillable = [
        'murid_id',
        'judul',
        'deskripsi',
        'jumlah',
        'bukti_pembayaran',
        'status',
    ];

    public function murid()
    {
        return $this->belongsTo(User::class, 'murid_id');
    }
}

