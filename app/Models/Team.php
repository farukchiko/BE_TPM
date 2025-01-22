<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['team_name', 'is_binusian'];

    public function members()
    {
        return $this->hasMany(Member::class, 'team_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}



