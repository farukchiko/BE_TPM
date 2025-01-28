<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens; // Pastikan ini diimpor

class Member extends Authenticatable
{
    use HasFactory, HasApiTokens; // Tambahkan HasApiTokens di sini

    protected $fillable = [
        'name',
        'email',
        'password',
        'team_id',
        'is_leader',
        'phone',
        'line_id',
        'github_id',
        'birth_place',
        'birth_date',
    ];

    protected $hidden = [
        'password',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
