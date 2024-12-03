<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';

    protected $fillable = [
        'imageURL',
        'name',
        'description',
    ];

    public function bookeds()
    {
        return $this->hasMany(booked::class, 'idEquipment');
    }
}
