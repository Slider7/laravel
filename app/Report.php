<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  public $timestamps = false;

  //Eloquent one-to-many inverse
  public function quizResult()
  {
    return $this->belongsTo(QuizResult::class, 'qr_id', 'qr_id');
  }

  public function quiz()
  {
    return $this->belongsTo(Quiz::class, 'quiz_id', 'quiz_id');
  }

  protected $table = 'all_quiz_res';
}
