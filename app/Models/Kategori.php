<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama',
        'icon', // <--- tambahkan ini ya Fadwa!
    ];

    /** 
     * Relasi ke tabel Jasa (One to Many)
     */
    public function jasa()
    {
        return $this->hasMany(Jasa::class);
    }

    /**
     * Relasi ke tabel pekerja (opsional, kalau nanti dipakai)
     */
    public function pekerja()
    {
        return $this->hasMany(User::class);
    }
}
