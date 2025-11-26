<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $fillable = ['nama', 'slug', 'deskripsi', 'harga', 'durasi', 'kontak', 'gambar'];
}

