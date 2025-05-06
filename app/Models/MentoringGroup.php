<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentoringGroup extends Model
{
    protected $table = 'mentoring_groups';
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
