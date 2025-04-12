<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory; //para que la factory funcione
    public function actors()
    {
        return $this->belongsToMany(
            Actor::class,
            'films_actors',
            'film_id',
            'actor_id'
        )->withTimestamps();
    }
}
