<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 
        'jasa_id', 
        'worker_id', 
        'alamat', 
        'tanggal', 
        'jumlah', 
        'status'
    ];

// ===== STATUS WORKFLOW =====
    const STATUS_PENDING_ADMIN     = 'pending_admin';
    const STATUS_REJECTED_ADMIN    = 'rejected_admin';
    const STATUS_WAITING_WORKER    = 'waiting_worker';  // Admin approve → pekerja lihat
    const STATUS_WORKER_ACCEPTED   = 'accepted_worker'; // Pekerja terima
    const STATUS_WORKER_REJECTED   = 'rejected_worker'; // Pekerja tolak
    const STATUS_FINISHED          = 'finished';        // Pekerja selesai


    // ===== RELATION =====
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class);
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}
