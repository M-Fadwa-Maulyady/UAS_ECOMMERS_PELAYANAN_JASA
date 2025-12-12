<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'status', 'bank_name', 'rekening'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
