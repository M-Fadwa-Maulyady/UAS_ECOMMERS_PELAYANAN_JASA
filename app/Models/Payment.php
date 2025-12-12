<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    'order_id',
    'user_id', // ← WAJIB ADA
    'method',
    'bank_name',
    'rekening_tujuan',
    'bukti_transfer',
    'status',
    'total',
    'fee_admin',
    'worker_receive'
];


    public function order() {
        return $this->belongsTo(Order::class);
    }
}

