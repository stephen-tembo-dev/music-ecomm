<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'status',
        'tx_ref',
        'isDelivered',
        'in_store_song_id',
        'user_id',
    ];

    public function payment(){
        return $this->belongsTo(\App\Models\InStoreSong::class);
    }
}
