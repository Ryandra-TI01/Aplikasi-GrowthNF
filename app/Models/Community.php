<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'communities';
    protected $guarded = ['id'];
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
