<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  public $timestamps = false;

  //Eloquent one-to-many inverse
  public function question()
  {
    return $this->belongsTo(Question::class, 'q_id', 'q_id');
  }

  protected $table = 'answers';
}
