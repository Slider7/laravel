<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  public $timestamps = false;

  //Eloquent one-to-many inverse
  public function answer()
  {
    return $this->hasMany(Answer::class, 'q_id', 'q_id');
  }

  protected $table = 'question';
}
