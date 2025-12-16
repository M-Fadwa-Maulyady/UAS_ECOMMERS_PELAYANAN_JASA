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
        'status',
        'payment_method',
        'bukti_pembayaran',
        'admin_fee',
        'total_transfer',
        'bukti_pengerjaan'
    ];

    // ===== STATUS MAP (FINAL FLOW) =====
    const STATUS_PENDING_ADMIN        = 'pending_admin';
    const STATUS_APPROVED_ADMIN       = 'approved_admin';

    const STATUS_WAITING_PAYMENT      = 'waiting_payment';
    const STATUS_WAITING_UPLOAD       = 'waiting_upload';
    const STATUS_WAITING_VERIFY       = 'waiting_verification';

    const STATUS_REJECTED_ADMIN       = 'rejected_admin';

    const STATUS_WAITING_WORKER       = 'waiting_worker';
    const STATUS_WORKER_ACCEPTED      = 'accepted_worker';
    const STATUS_WORKER_REJECTED      = 'rejected_worker';

    const STATUS_WAITING_USER_CONFIRM = 'waiting_user_confirmation';
    const STATUS_REVISION             = 'revision_requested';

    const STATUS_FINISHED             = 'finished';


    // ===== RELATIONSHIP =====

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


    // ===== ACCESSOR TAMBAHAN (OPTIONAL BAGUS DIPAKAI) =====

    public function getAdminShareAttribute()
    {
        return $this->total_transfer * 0.10; // admin 10%
    }

    public function getWorkerShareAttribute()
    {
        return $this->total_transfer - $this->admin_share;
    }

    public function messages()
    {
        return $this->hasMany(OrderMessage::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }


}
