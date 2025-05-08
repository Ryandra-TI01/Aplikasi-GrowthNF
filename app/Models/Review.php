<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
    public function mentoring_session(){
        return $this->belongsTo(MentoringSession::class);
    }
}
