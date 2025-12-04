<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'durasi',
        'kontak',
        'gambar',

        'nama_jasa',
        'estimasi_waktu',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

