<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $fillable = [
        'user_id',
        'nama_jasa',
        'slug',
        'deskripsi',
        'harga',
        'durasi',
        'kontak',
        'gambar',
        'estimasi_waktu',
        'kategori_id',
        'status',
        'alasan_tolak',
    ];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}


