<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'durasi',
        'kontak',
        'gambar',

        // untuk pekerja
        'nama_jasa',
        'estimasi_waktu',
        'jumlah_revisi',
    ];
}
