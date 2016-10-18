<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ResultDetail;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Term;
use App\Models\Year;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ResultRequest;
use App\Http\Requests\ResultDetailRequest;
use Cart;

class ResultController extends Controller
{
    protected $resultCart = 'resultCart';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return 'rest';
    }

    public function create()
    {
        $studentList = Student::pluck('name', 'id');
        $termList = Term::pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');
        $subjectList = Subject::pluck('name', 'id');
        $addedList = Cart::instance($this->resultCart)->content();
        return view('result.create', compact('studentList', 'termList', 'yearList', 'subjectList', 'addedList'));
    }

    public function addToCart(ResultRequest $request)
    {
        $subject = Subject::find($request->subject_id);
        $getMarkPercentage = (100 * $request->get_mark) / $subject->total_mark;
        $getMarkPercentage = round($getMarkPercentage);
        //$this->validate($request, $this->addResultRule);
        //return $request->all();
        if( ($getMarkPercentage >= 80) && ($getMarkPercentage <= 100)) {
            $grade = 'A+';
            $gradePoint = 5;
        }
        else if( ($getMarkPercentage >= 70) && ($getMarkPercentage <= 79)) {
            $grade = 'A';
            $gradePoint = 4;
        }
        else if( ($getMarkPercentage >= 60) && ($getMarkPercentage <= 69)) {
            $grade = 'A-';
            $gradePoint = 3.5;
        }
        else if( ($getMarkPercentage >= 50) && ($getMarkPercentage <= 59)) {
            $grade = 'B';
            $gradePoint = 3;
        }
        else if( ($getMarkPercentage >= 40) && ($getMarkPercentage <= 49)) {
            $grade = 'C';
            $gradePoint = 2;
        }
        else if( ($getMarkPercentage >= 33) && ($getMarkPercentage <= 39)) {
            $grade = 'D';
            $gradePoint = 1;
        }
        else {
            $grade = 'F';
            $gradePoint = 0;
        }

        Cart::instance($this->resultCart)->add([
                      'id' => $request->subject_id,
                      'name' => $subject->name,
                      'qty' => 1,
                      'price' => $request->get_mark,
                      'options' => ['subject' => $subject, 'grade' => $grade, 'gradePoint' => $gradePoint, 'getMarkPercentage' => $getMarkPercentage],
                  ]);

        return redirect('result/create');
    }

    public function removeList($d)
    {
        Cart::instance($this->resultCart)->remove($d);
        flash()->warning('One subject is removed from List.');

        return redirect()->back();
    }

    public function clearAllLists()
    {
        if (Cart::instance($this->resultCart)->count() > 0) {
            Cart::instance($this->resultCart)->destroy();
//            flash()->error('All item(s) are removed from List.');
            return redirect()->back();
        }

        flash()->warning('List is already Empty.');
        return redirect()->back();
    }

    public function saveCart(ResultDetailRequest $request)
    {
        $cart = Cart::instance($this->resultCart)->content();

        if(count($cart)){
            $deleteResult = Result::where('student_id', $request->student_id)
                                    ->where('term_id', $request->term_id)
                                    ->where('year_id', $request->year_id)
                                    ->get();
            if( count($deleteResult) ) {
                ResultDetail::where('result_id', $deleteResult[0]->id)->delete();
                Result::where('student_id', $request->student_id)->delete();
            }
            $result = Result::create($request->all());

            $data = [];
            foreach ($cart as $item) {

                $data= [
                    'result_id' => $result->id,
                    'subject_id' => $item->options->subject->id,
                    'get_mark' => $item->price,
                    'get_mark_percentage' => $item->options->getMarkPercentage,
                    'grade' => $item->options->grade,
                    'grade_point' => $item->options->gradePoint
                ];

//                dd($data);
                 $resultDetails = ResultDetail::create($data);

            }
        }else{
            flash()->warning('No Subject has been added to List.');
            return redirect()->back()->withInput();
        }

        $this->clearAllLists();

        return redirect('result/' . $result->id);
    }

    public function show($id)
    {
        $result = Result::with([
                                   'student',
                                   'term',
                                   'year',
                                   'student.level',
                                   'student.section',
                                   'student.year'
                               ])
                            ->find($id);

        $resultDetails = ResultDetail::with(['subject'])
            ->where('result_id', $result->id)
            ->orderBy('subject_id', 'asc')
            ->get();


        return view('result.show', compact('result', 'resultDetails'));
    }
}
