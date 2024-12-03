<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'date',
        'idMember',
    ];

    public function member()
    {
        return $this->belongsTo(Membership::class, 'idMember');
    }

    public function user()
    {
        return $this->hasMany(Users::class, 'idPayment');
    }
}
