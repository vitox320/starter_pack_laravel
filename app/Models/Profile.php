<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'profile_abilities');
    }


}
