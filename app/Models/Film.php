<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;//para que la factory funcione

    protected $fillable = [
        'name',
        'year',
        'genre',
        'country',
        'duration',
        'img_url',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    //public function actors() 1:N
    //public function actors() N:N
    //belongsToMany Actor
}
