<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',

        // Profil dasar
        'alamat',
        'no_telp',

        // Role
        'role',

        // Profil pekerja
        'nama_usaha',
        'kategori_jasa',
        'deskripsi_jasa',

        // Verifikasi
        'ktp',
        'profile_filled',
        'is_verified_by_admin',      // 0 = pending, 1 = approved, 2 = ditolak
        'verification_note',         // alasan penolakan

        // Rekening
        'rekening_bank',
        'rekening_nama',
        'rekening_nomor',

        // Pro fitur
        'is_pro_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at'   => 'datetime',
        'profile_filled'      => 'boolean',
        'is_verified_by_admin'=> 'integer',
        'is_pro_active'       => 'boolean',
        'password'            => 'hashed',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'worker_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'worker_id');
    }



}
