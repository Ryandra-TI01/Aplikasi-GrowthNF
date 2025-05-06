<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentoringApplication extends Model
{
    protected $table = 'mentoring_applications';
    public function mentoringSession()
    {
        return $this->belongsTo(MentoringSession::class);
    }
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
