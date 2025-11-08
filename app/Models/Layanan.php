<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    public function isAvailable()
    {
        return $this->stok > 0;
    }

    public function decreaseStock()
    {
        if ($this->stok > 0) {
            $this->stok -= 1;
            $this->save();
        }
    }

    public function increaseStock()
    {
        $this->stok += 1;
        $this->save();
    }

}

