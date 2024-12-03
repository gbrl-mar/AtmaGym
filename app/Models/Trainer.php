<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $table = 'trainers';

    protected $fillable = [
        'name',
        'specialization',
        'rating',
        'imageUrl',
    ];

    public function bookeds()
    {
        return $this->hasMany(Booked::class, 'idTrainer');
    }
}
