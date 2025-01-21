<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * Tabel yang terkait dengan model ini.
     */
    protected $table = 'members';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'team_id',
        'name',
        'email',
        'is_leader',
        'password',
    ];

    /**
     * Sembunyikan atribut ini saat serialisasi (misalnya pada API response).
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Relasi dengan model Team (satu tim memiliki banyak anggota).
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
