<?php

namespace App\Http\Controllers;

use App\QuizResult;
use Illuminate\Http\Request;

class QuizResultController extends Controller
{
  public function index()
  {
    return $results = QuizResult::with('quiz')->orderBy('finished_at')->take(25)->get();
  }

  public function show(QuizResult $quiz_result)
  {
    $id = $quiz_result->qr_id;
    return $results = QuizResult::with('quiz')->where('qr_id', '=', "$id")->get();
  }

  public function teachers()
  {
    return QuizResult::orderby('teacher')->distinct()->pluck('teacher');
  }

  public function groups()
  {
    return QuizResult::orderby('gruppa')->distinct()->pluck('gruppa');
  }
}
