<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
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
        'uploaded_by'
    ];

    public function comments(){
        return $this->hasMany(\App\Models\Comment::class);
    }
}
