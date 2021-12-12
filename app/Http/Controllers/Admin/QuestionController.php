<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Matrix\trace;

class QuestionController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_question']);
  }
  public function index()
  {
    $questions = Question::with('answer')->paginate(20);
    return view('admin.pages.ques-answer.ques&Answers' , compact('questions'));

  }
  public function create()
  {
    return view('admin.pages.ques-answer.ques&Answers-form');

  }

  public function storeQues(Request $request)
  {
    try {
      $rules = [
        'question' => 'required|max:255',
        'points' => 'required|numeric',
        'answer1' => 'required|max:255',
        'answer2' => 'required|max:255',
        'answer3' => 'required|max:255',
        'answer4' => 'required|max:255',
      ] ;
      $this->validate($request,$rules);
      DB::beginTransaction();
      $question = $request->only(['question', 'points']);
      $question_id = Question::insertGetId($question);
      ////////// answer 1 /////////
      $answer1['answer'] = $request->answer1;
      $request->has('rdo1') ? $answer1['is_correct'] = 1 : $answer1['is_correct'] = 0;
      $answer1['question_id'] = $question_id;
      Answer::create($answer1);

      ////////////// answer 2 ///////////////////
      $answer2['answer'] = $request->answer2;
      $request->has('rdo2') ? $answer2['is_correct'] = 1 : $answer2['is_correct'] = 0;
      $answer2['question_id'] = $question_id;
      Answer::create($answer2);

      ///////////// answer 3 ////////////////
      $answer3['answer'] = $request->answer3;
      $request->has('rdo3') ? $answer3['is_correct'] = 1 : $answer3['is_correct'] = 0;
      $answer3['question_id'] = $question_id;
      Answer::create($answer3);

      ////////////// answer 4 ///////////////
      $answer4['answer'] = $request->answer4;
      $request->has('rdo4') ? $answer4['is_correct'] = 1 : $answer4['is_correct'] = 0;
      $answer4['question_id'] = $question_id;
      Answer::create($answer4);
      DB::commit();
      return redirect()->route('ques_index')->with(['success' => 'question and answers add successfully']);
    } catch ( \Exception $exception) {
      DB::rollBack();
      $this->validate($request,$rules );
      return redirect()->route('ques_create')->with(['errors' => 'some error occur']);

    }
  }

  public function editQues ($id)
  {
    $question = Question::findOrFail($id);
    return view('admin.pages.ques-answer.ques&Answers-edit' , compact('question' ));

  }

  public function updateQues(Request $request , $id)
  {
    $rules = [
      'question' => 'required|max:255',
      'points' => 'required|numeric',
      'answer1' => 'required|max:255',
      'answer2' => 'required|max:255',
      'answer3' => 'required|max:255',
      'answer4' => 'required|max:255',
    ] ;
    try {

      $question = Question::findOrFail($id);
      $question->delete();

      $this->validate($request,$rules);
      DB::beginTransaction();
      $question = $request->only(['question', 'points']);
      $question_id = Question::insertGetId($question);
      ////////// answer 1 /////////
      $answer1['answer'] = $request->answer1;
      $request->has('rdo1') ? $answer1['is_correct'] = 1 : $answer1['is_correct'] = 0;
      $answer1['question_id'] = $question_id;
      Answer::create($answer1);

      ////////////// answer 2 ///////////////////
      $answer2['answer'] = $request->answer2;
      $request->has('rdo2') ? $answer2['is_correct'] = 1 : $answer2['is_correct'] = 0;
      $answer2['question_id'] = $question_id;
      Answer::create($answer2);

      ///////////// answer 3 ////////////////
      $answer3['answer'] = $request->answer3;
      $request->has('rdo3') ? $answer3['is_correct'] = 1 : $answer3['is_correct'] = 0;
      $answer3['question_id'] = $question_id;
      Answer::create($answer3);

      ////////////// answer 4 ///////////////
      $answer4['answer'] = $request->answer4;
      $request->has('rdo4') ? $answer4['is_correct'] = 1 : $answer4['is_correct'] = 0;
      $answer4['question_id'] = $question_id;
      Answer::create($answer4);
      DB::commit();
      return redirect()->route('ques_index')->with(['success' => 'question and answers update successfully']);
    } catch (\Exception $exception) {

      DB::rollBack();
//      return $exception->getMessage();
      $this->validate($request,$rules );
      return redirect()->route('ques_create')->with(['errors' => 'some error occur']);

    }
  }

  public function deleteQues($id)
  {
    $question = Question::findOrFail($id);
    $question->delete();
    return redirect()->route('ques_index')->with(['success' => 'question and answers deleted successfully']);


  }


}
