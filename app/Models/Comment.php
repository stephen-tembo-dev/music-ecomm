<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'song_id',
        'user_id'
    ];

    public function comment(){
        return $this->belongsTo(\App\Models\User::class);
    }

    public function song(){
        return $this->belongsTo(\App\Models\Song::class);
    }
}
