<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * Tabel yang terkait dengan model ini.
     */
    protected $table = 'teams';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
        'institution',
        'is_binusian',
    ];

    /**
     * Relasi dengan model Member.
     * Satu tim memiliki banyak anggota.
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
