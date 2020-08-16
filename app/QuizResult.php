<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'teacher', 'stud_name', 'user_score', 'pass_score', 'quiz_time', 'finished_at', 'stud_percent', 'gruppa', 'age', 'phone', 'email'
  ];

  public function path()
  {
    return route('quizresults.show', $this);
  }

  //Eloquent one-to-many inverse
  public function quiz()
  {
    return $this->belongsTo(Quiz::class, 'quiz_id', 'quiz_id');
  }

  protected $table = 'quiz_results';
  protected $primaryKey = 'qr_id';
}
