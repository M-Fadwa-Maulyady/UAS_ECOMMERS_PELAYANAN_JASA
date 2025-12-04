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
    'alamat',
    'no_telp',
    'role',
    'nama_usaha',
    'kategori_jasa',
    'deskripsi_jasa',

    // Tambahan
    'ktp',
    'profile_filled',
    'rekening_bank',
    'rekening_nama',
    'rekening_nomor',
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'profile_filled' => 'boolean',
        'is_verified_by_admin' => 'boolean',
        'is_pro_active' => 'boolean',
        'password' => 'hashed',
    ];
}
