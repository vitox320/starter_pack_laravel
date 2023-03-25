<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_abilities');
    }
}
