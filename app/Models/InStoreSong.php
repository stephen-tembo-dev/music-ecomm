<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InStoreSong extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist',
        'title',
        'featuring',
        'genre',
        'year',
        'cover',
        'song',
        'price',
        'uploaded_by'
    ];

    public function payments(){
        return $this->hasMany(\App\Models\Payment::class);
    }
}
