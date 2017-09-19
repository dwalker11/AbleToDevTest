<?php

namespace App\Http\Controllers;

use App\Question;
use App\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('survey')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $survey = \DB::table('surveys')
            ->join('question_survey', 'surveys.id', '=', 'question_survey.survey_id')
            ->join('questions', 'questions.id', '=', 'question_survey.question_id')
            ->join('options', 'options.id', '=', 'question_survey.answer')
            ->select('surveys.id as survey_id', 'questions.text as question', 'options.text as answer')
            ->where('surveys.user_id', '=', $user->id)
            ->get()
            ->groupBy('survey_id')
            ->last();

        return view('dashboard', ['surveyResult' => $survey ?? []]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::all()->map(function ($question) {
          $options = $question->options->map(function ($option) {
              return ['id' => $option->id, 'text' => $option->text];
          });

          return [
            'id'       => $question->id,
            'text'     => $question->text,
            'answered' => false,
            'options'  => $options->all()
          ];
        })->toJson();

        return view('survey', ['questions' => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \Auth::user();

        $input = $request->except(['_token']);

        $results = [];
        foreach ($input as $questionIndex => $selectedOption) {
            $questionIndex = ltrim($questionIndex, 'question');
            $results[$questionIndex] = ['answer' => $selectedOption];
        }

        $survey = new Survey;
        $survey->user_id = $user->id;
        $survey->save();
        $survey->questions()->attach($results);

        return redirect('surveys');
    }
}
