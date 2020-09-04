<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
  public function index()
  {
    return $results = Answer::with('question')->orderBy('q_id')->take(25)->get();
  }

  public function show($qr_id)
  {
    return $results = Answer::join('question as q', 'answers.q_id', '=', 'q.q_id')
      ->where('answers.qr_id', '=', "$qr_id")
      ->orderBy('q.q_id')
      ->get();
  }
}
