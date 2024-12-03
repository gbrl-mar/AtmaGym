<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabangs extends Model
{
    use HasFactory;

    protected $table = 'cabangs';

    protected $fillable = [
        'imageURL',
        'gymName',
        'openingHours',
        'closingHours',
        'description',
        'latitude',
        'longitude',
        'idBook',
    ];

    public function bookeds()
    {
        return $this->belongsTo(Booked::class, 'idBook');
    }
}
