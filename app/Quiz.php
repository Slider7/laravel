<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'quiz_name', 'quiz_code', 'program', 'unit'
    ];
    public function path(){
        return route('quizzes.show', $this);
    }

    protected $table = 'quiz';
    protected $primaryKey = 'quiz_id';
}
