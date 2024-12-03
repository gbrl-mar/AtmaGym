<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel yang digunakan model ini.
     */
    protected $table = 'users';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'username',
        'email',
        'birthdate',
        'gender',
        'password',
        'weight',
        'height',
        'idMember',
        'idPayment',
        'remember_token',
    ];

    /**
     * Atribut yang harus disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi dengan tabel memberships.
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'idMember');
    }

    /**
     * Relasi dengan tabel payments.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'idPayment');
    }
}