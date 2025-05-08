<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentoringSession extends Model
{
    protected $table = 'mentoring_sessions';
    protected $guarded = ['id'];
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
