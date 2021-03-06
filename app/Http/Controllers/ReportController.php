<?php

namespace App\Http\Controllers;

use DateTime;

use App\Report;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  public function index()
  {
    return Report::orderBy('finished_at')->take(25)->get();
  }


  public function filterReport($teacher, $program, $unit, $gruppa, $period)
  {
    $params = ['teacher' => $teacher, 'program' => $program, 'unit' => $unit, 'gruppa' => $gruppa, 'period' => $period];
    $query = Report::select('stud_name', 'phone', 'teacher', 'program', 'unit', 'gruppa', 'user_score', 'finished_at', 'quiz_time', 'qr_id');

    foreach ($params as $key => $val) {
      if ($key != 'period') {
        $condition = $params[$key];
        if ($condition != 'none') {
          $query = $query->where($key, "$condition");
        }
      }
    }
    if ($params['period'] != 'none') {
      $beginDate = new DateTime();
      date_modify($beginDate, '-'. $params['period'] .' days');
      $query = $query->where('finished_at', '>=', $beginDate->format('Y-m-d'));
    };

    $results = $query->take(100)->get();
    return $results;
  }


  public function GroupedReport($teacher, $program, $unit, $gruppa, $period)
  {
    $params = ['teacher' => $teacher, 'program' => $program, 'unit' => $unit, 'gruppa' => $gruppa, 'period' => $period];

    $query = DB::table('all_quiz_res')
      ->select('teacher', 'program', 'unit', 'gruppa', DB::raw('count(*) as cnt'), DB::raw('FORMAT(avg(stud_percent), 2) as avg_prc'));

    foreach ($params as $key => $val) {
      if ($key != 'period') {
        $condition = $params[$key];
        if ($condition != 'none') {
          $query = $query->where($key, "$condition");
        }
      }
    }

    if ($params['period'] != 'none') {
      $beginDate = new DateTime();
      date_modify($beginDate, '-'. $params['period'] .' days');
      $query = $query->where('finished_at', '>=', $beginDate->format('Y-m-d'));
    };

    $results = $query->groupBy('teacher', 'quiz_code', 'gruppa')->orderBy('teacher')->get();
    return $results;
  }

  public function GruppaDetailReport($teacher, $program, $unit, $gruppa, $period)
  {
    $params = ['teacher' => $teacher, 'program' => $program, 'unit' => $unit, 'gruppa' => $gruppa, 'period' => $period];

    $query = DB::table('all_quiz_res')
      ->join('quiz_detail2', 'all_quiz_res.qr_id', '=', 'quiz_detail2.qr_id')
      ->select(
        'all_quiz_res.qr_id',
        'all_quiz_res.stud_name',
        'all_quiz_res.gruppa',
        'all_quiz_res.user_score',
        'all_quiz_res.pass_score',
        'all_quiz_res.stud_percent',
        DB::raw('CAST(SUBSTRING(q_text, 1, 3) AS UNSIGNED) as qtext'),
        DB::raw("concat(quiz_detail2.award_points,  ' из ' , quiz_detail2.maxpoint) as points"),
        'quiz_detail2.result',
        'quiz_detail2.award_points',
        'quiz_detail2.maxpoint'
      );

    foreach ($params as $key => $val) {
      if ($key != 'period') {
        $condition = $params[$key];
        if ($condition != 'none') {
          $query = $query->where('all_quiz_res.' . $key, "$condition");
        }
      }
    }

    if ($params['period'] != 'none') {
      $beginDate = new DateTime();
      date_modify($beginDate, '-'. $params['period'] .' days');
      $query = $query->where('all_quiz_res.finished_at', '>=', $beginDate->format('Y-m-d'));
    };

    $results = $query->orderBy('qr_id')->orderBy('q_id')->get();
    return $results;
  }
}
