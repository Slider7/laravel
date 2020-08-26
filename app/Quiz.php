<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
  public $timestamps = false;
  protected $fillable = [
    'quiz_name', 'quiz_code', 'program', 'unit'
  ];
  public function path()
  {
    return route('quizmanage.show', $this);
  }

  public function quizResult()
  {
    return $this->hasMany(QuizResult::class, 'quiz_id', 'quiz_id');
  }

  protected $table = 'quiz';
  protected $primaryKey = 'quiz_id';
}
