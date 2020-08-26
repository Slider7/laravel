<?php

namespace App\Http\Controllers;

use Session;
use App\Quiz;
use \App\QuizREsult;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class QuizController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('quiz.index', [
      'quizzes' => Quiz::orderBy('quiz_name')->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('quiz.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    /*      $quiz = new Quiz();
        $quiz->quiz_name = request('quiz_name');
        $quiz->quiz_code = request('quiz_code');
        $quiz->Program = request('program');
        $quiz->Unit = request('unit');
        $quiz->save();      */

    Quiz::create($this->validateQuiz());
    return redirect('/quizmanage');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Quiz  $quiz
   * @return \Illuminate\Http\Response
   */
  public function show(Quiz $quiz)
  {
    //$quiz = Quiz::findOrFail($id);
    return view('quiz.show', ['quiz' => $quiz]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Quiz  $quiz
   * @return \Illuminate\Http\Response
   */
  public function edit(Quiz $quiz)
  {
    return view('quiz.edit', compact('quiz'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Quiz  $quiz
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Quiz $quiz)
  {
    $quiz->update($this->validateQuiz());

    return redirect($quiz->path());
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Quiz  $quiz
   * @return \Illuminate\Http\Response
   */
  public function destroy(Quiz $quiz)
  {
    $quizzes = QuizResult::distinct()->select('quiz_id')->where('quiz_id', '=', $quiz->quiz_id)->get();
    if ($quizzes->count() === 0){
      $destroy = Quiz::destroy($quiz->quiz_id);
      if ($destroy) {
        Session::flash('message','Quiz ' . $quiz->quiz_code .' успешно удален.');
      } else {
        Session::flash('message','Quiz ' . $quiz->quiz_code .' не был удален. Есть зависимости/ошибка при удалении.');
      };
    } else {
      Session::flash('message','Quiz ' . $quiz->quiz_code .' невозможно удалить - существуют тестирования по данному quiz-у.');
    };

    return redirect('/quizmanage');
  }

  public function programs()
  {
    return Quiz::orderby('program')->distinct()->pluck('program');
  }

  public function units()
  {
    return Quiz::orderby('unit')->distinct()->pluck('unit');
  }

  public function periods()
  {
    $periodList = array('1 день', '1 неделя', '1 месяц', '1 квартал', '1 полугодие', '1 год');

    return $periodList;
  }


  //созданный специально во избежание дублирования кода метод для валидации
  protected function validateQuiz()
  {
    return request()->validate([
      'quiz_name' => ['required', 'min:3', 'max:200'],
      'quiz_code' => '',
      'program' => 'required',
      'unit' => 'required',
    ]);
  }
}
