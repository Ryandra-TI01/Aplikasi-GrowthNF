<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';
    public function community()
    {
        return $this->hasMany(Community::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
