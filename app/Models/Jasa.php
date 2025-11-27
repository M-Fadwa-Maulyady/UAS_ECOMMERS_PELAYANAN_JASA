<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{

    protected $fillable = ['nama', 'slug', 'deskripsi', 'harga', 'durasi', 'kontak', 'gambar'];
}


    use HasFactory;

    protected $fillable = [
        'nama_jasa',
        'deskripsi',
        'estimasi_waktu',
        'harga',
        'jumlah_revisi',
        'gambar',
    ];
}

