<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'communities';
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
