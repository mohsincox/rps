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
        $results = Result::with(['student', 'term', 'year', 'student.level', 'student.section'])->get();

        return view('result.index', compact('results'));
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
        else if( ($getMarkPercentage >= 0) && ($getMarkPercentage <= 32)) {
            $grade = 'F';
            $gradePoint = 0;
        }
        else {
            $grade = null;
            $gradePoint = '<strong style="color: red;">Wrong Input</strong>';
        }
        //return $request->subject_id;
        $cartSubjects = Cart::instance($this->resultCart)->content();
        foreach($cartSubjects as $cartSubject) {

            //echo $cartSubject->id;
            if($cartSubject->id == $request->subject_id){

                flash()->error('This Subject is Already Exist.');
                return redirect()->back();
            }
        }
        //return null;
        //count($subject->id);
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

        foreach( $cart as $c ) {
            if(is_string($c->options->gradePoint)) {
                flash()->error('Wrong Input');
                return redirect()->back();
            }
        }

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
            $totalGradePoint = 0;
            foreach ($cart as $item) {

                $data= [
                    'result_id' => $result->id,
                    'subject_id' => $item->options->subject->id,
                    'get_mark' => $item->price,
                    'get_mark_percentage' => $item->options->getMarkPercentage,
                    'grade' => $item->options->grade,
                    'grade_point' => $item->options->gradePoint
                ];

                 $resultDetails = ResultDetail::create($data);
                 $totalGradePoint += $resultDetails->grade_point;

            }
        }else{
            flash()->warning('No Subject has been added to List.');
            return redirect()->back()->withInput();
        }

        $result->update([
                            'student_id' => $request->student_id,
                            'term_id' => $request->term_id,
                            'year_id' => $request->year_id,
                            'total_point' => $totalGradePoint
                        ]);
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

        $resultDetailsBySubject = Subject::with(
            ['resultDetails' => function($query) use($result) {
                $query->where('result_id', $result->id);
            }]
        )->get();

        $i = 0;
        $totalPoint = 0;
        $isFail = false;
        foreach($resultDetailsBySubject as $details) {

            if(count($details->resultDetails) == 0) {
                $isFail = true;
                ++$i;
                if($resultDetailsBySubject->count() == $i) {
                    $pointResult =  $isFail? 'Failed' : $totalPoint;
                }
            }
            else {
                if($details->resultDetails->first()->get_mark < $details->pass_mark) {
                    $isFail = true;
                    ++$i;
                    if($resultDetailsBySubject->count() == $i) {
                        $pointResult =  $isFail? 'Faileddd' : $totalPoint;
                        //dd($pointResult);
                    }
                }
                else {
                    $totalPoint += $details->resultDetails->first()->grade_point;
                    ++$i;
                    if($resultDetailsBySubject->count() == $i) {

                        $pointResult =  $isFail? 'Failed' : $totalPoint;
                    }
                    //$totalPoint += $details->resultDetails->first()->grade_point;
                }
            }
        }

        return view('result.show', compact('result', 'resultDetailsBySubject', 'pointResult'));
    }
}
