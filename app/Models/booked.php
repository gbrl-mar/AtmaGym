<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booked extends Model
{
    use HasFactory;

    protected $table = 'bookeds';

    protected $fillable = [
        'idUser',
        'idTrainer',
        'idEquipment',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'idUser');
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'idTrainer');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'idEquipment');
    }

    public function cabang()
    {
        return $this->hasOne(cabangs::class, 'idBook');
    }
}
