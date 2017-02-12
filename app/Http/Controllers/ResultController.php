<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Result;
use App\Models\ResultDetail;
use App\Models\Section;
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
    protected $_resultEditCart = '_resultEditCart';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $results = Result::with([
                                    'term',
                                    'student.level',
                                    'student.section',
                                    'student.year'
                                ])
                                ->get();

        return view('result.index', compact('results'));
    }

    public function create()
    {
        $studentList = Student::pluck('name', 'id');
        $classList = Level::pluck('name', 'id');
        $termList = Term::pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');
        $subjectList = Subject::pluck('name', 'id');
        $addedList = Cart::instance($this->resultCart)->content();
        return view('result.create', compact('studentList', 'termList', 'yearList', 'subjectList', 'addedList', 'classList'));
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

    public function removeOneSubject($id)
    {
        Cart::instance($this->resultCart)->remove($id);
        flash()->warning('One subject is removed from List.');

        return redirect()->back();
    }

    public function clearAllSubjects()
    {
        if (Cart::instance($this->resultCart)->count() > 0) {
            Cart::instance($this->resultCart)->destroy();
            flash()->error('All Subject(s) are removed from List.');
            return redirect()->back();
        }

        flash()->warning('List is already Empty.');
        return redirect()->back();
    }

    public function clearAllSubjectsAfterSave()
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
        //return $request->all();
        //return $student = Student::find($request->student_id);
        $cart = Cart::instance($this->resultCart)->content();

        foreach( $cart as $c ) {
            if(is_string($c->options->gradePoint)) {
                flash()->error('Wrong Input');
                return redirect()->back();
            }
        }

        $student = Student::find($request->student_id);
        if(!count($student)){
            flash()->error('There is no Student in this ID');
            return redirect()->back();
        }
        

        if(count($cart)){
            $deleteResult = Result::where('student_id', $request->student_id)
                                    ->where('level_id', $student->level_id)
                                    ->where('section_id', $student->section_id)
                                    ->where('year_id', $student->year_id)
                                    ->where('term_id', $request->term_id)
                                    ->get();
            if( count($deleteResult) ) {
                //ResultDetail::where('result_id', $deleteResult[0]->id)->delete();
                //Result::where('student_id', $request->student_id)->delete();
                flash()->error("This Student's Result already created in this Term.");
                return redirect()->back();
            }

            $result = Result::create([
                                        'student_id' => $request->student_id,
                                        'level_id' => $student->level_id,
                                        'section_id' => $student->section_id,
                                        'year_id' => $student->year_id,
                                        'term_id' => $request->term_id,
                                     ]);

            $data = [];
            $totalGradePoint = 0;
            $totalGetMark = 0;
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
                 $totalGetMark += $resultDetails->get_mark;

            }
        }else{
            flash()->warning('No Subject has been added to List.');
            return redirect()->back()->withInput();
        }

        $result->update([
                            'student_id' => $request->student_id,
                            'level_id' => $student->level_id,
                            'section_id' => $student->section_id,
                            'year_id' => $student->year_id,
                            'term_id' => $request->term_id,
                            'total_point' => $totalGradePoint,
                            'total_get_mark' => $totalGetMark
                        ]);
        $this->clearAllSubjectsAfterSave();

        return redirect('result/' . $result->id);
    }

    public function show($id)
    {
        $result = Result::with([
                                   'term',
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

        $totalPoint = 0;
        $isFail = false;
        foreach($resultDetailsBySubject as $details) {

            if(count($details->resultDetails) == 0) {
                $isFail = true;
                $totalResult =  $isFail? 'Failed' : $totalPoint;
                $stringResult = 'Failed';
                $gradePointAvg = 0.00;
                $totalMarks = $result->total_get_mark;
                break;
            }
            else {
                if($details->resultDetails->first()->get_mark < $details->pass_mark) {
                    $isFail = true;
                    $totalResult =  $isFail? 'Failed' : $totalPoint;
                    $stringResult = 'Failed';
                    $gradePointAvg = 0.00;
                    $totalMarks = $result->total_get_mark;
                    break;
                }
                else {
                    $totalPoint += $details->resultDetails->first()->grade_point;
                    $totalResult =  $isFail? 'Failed' : $totalPoint;
                    $gpa = $totalResult/11;
                    $totalResult =  round($gpa, 2, PHP_ROUND_HALF_UP);
                    $stringResult = strval($totalResult);
                    $gradePointAvg = $totalResult;
                    $totalMarks = $result->total_get_mark;

                }
            }
        }

        $totalAbsentCount = 0;
        $tempAbsent = 0;
        $tempFail = 0;
        $totalFailCount = 0;
        $notFailCount = 0;
        foreach($resultDetailsBySubject as $failCountSubject) {
            if(count($failCountSubject->resultDetails) == 0) {
                $tempAbsent++;
               // $totalAbsentCount += $tempAbsent;
            }
            else {
                if($failCountSubject->resultDetails->first()->get_mark < $failCountSubject->pass_mark) {
                    $tempFail++;
                    //$totalFailCount += $tempFail;
                }
                else {
                    $notFailCount = 0;
                }
            }

        }
        $totalFail = $tempAbsent + $tempFail + $notFailCount;
//        echo $totalResult;
//        return null;
        $result->update([
                       'result' => $stringResult,
                       'grade_point_avg' => $gradePointAvg,
                        'fail_subject' => $totalFail
                  ]);

        return view('result.show', compact('result', 'resultDetailsBySubject', 'totalResult', 'gradePointAvg', 'totalMarks', 'totalFail'));
    }

    public function showResultForm()
    {
        $classList = Level::pluck('name', 'id');
        $sectionList = Section::pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');
        $termList = Term::pluck('name', 'id');

        return view('result.report.form', compact('classList', 'termList', 'yearList', 'sectionList'));
    }

    public function showResult(Request $request)
    {
        $results = Result::with(['student.level', 'student.section', 'student.year', 'term'])
            ->where('level_id', $request->level_id)
            ->where('section_id', $request->section_id)
            ->where('year_id', $request->year_id)
            ->where('term_id', $request->term_id)
            ->orderBy('total_get_mark', 'desc')
            ->orderBy('fail_subject', 'asc')
            ->get();

        if(!count($results)) {
            flash()->error('There is no result');

            return redirect()->back();
        }

        return view('result.report.show', compact('results'));
    }

    public function studentNameShow(Request $request) {
        $student = Student::find($request->student_id);
        if(!$student) {
            return '<strong style="color: red; margin-left: 15px;">Entered Wrong ID of Student.</strong>';
        }
        return view('result.student_name_show', compact('student'));
    }

    public function destroy($id) {
        $result = Result::find($id);
        ResultDetail::where('result_id', $result->id)->delete();
        Result::destroy($id);

        flash()->error('Successfully Deleted.');

        return redirect('result');
    }

    public function showResultFailForm()
    {
        $classList = Level::pluck('name', 'id');
        $sectionList = Section::pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');
        $termList = Term::pluck('name', 'id');

        return view('result.report.fail_form', compact('classList', 'termList', 'yearList', 'sectionList'));
    }

    public function showResultFail(Request $request)
    {
        $results = Result::with(['student.level', 'student.section', 'student.year', 'term'])
            ->where('level_id', $request->level_id)
            ->where('section_id', $request->section_id)
            ->where('year_id', $request->year_id)
            ->where('term_id', $request->term_id)
            ->where('fail_subject', $request->fail_subject)
            ->orderBy('total_get_mark', 'desc')
            ->get();

        if(!count($results)) {
            flash()->error('There is no result');

            return redirect()->back();
        }
        return view('result.report.fail_show', compact('results'));
    }


    public function printForm()
    {
        $classList = Level::pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');
        $termList = Term::pluck('name', 'id');

        //return view('result.report.fail_form', compact('classList', 'termList', 'yearList', 'sectionList'));
        return view('result.report.print_result.form', compact('classList', 'termList', 'yearList'));
    }

    public function printShow(Request $request)
    {
        $results = Result::with(
            ['student.level', 'student.section', 'student.year', 'term']
        )
                         ->where('level_id', $request->level_id)
                         ->where('year_id', $request->year_id)
                         ->where('term_id', $request->term_id)
                         ->where('fail_subject', $request->fail_subject)
                         ->orderBy('total_get_mark', 'desc')
                         ->get();

        if (!count($results)) {
            flash()->error('There is no result');

            return redirect()->back();
        }

        //return view('result.report.fail_show', compact('results'));
        return view('result.report.print_result.show', compact('results'));
    }
    public function edit($id)
    {
        $result = Result::find($id);
        $resultId = $result->id;
        $cartName = $this->_resultEditCart.$result->id;

        $resultDetails = ResultDetail::where('result_id', $result->id)->get();
        //$cart = Cart::instance($cartName)->content();
        foreach($resultDetails as $detail)
        {
            $subject = Subject::find($detail->subject_id);
            $getMarkPercentage = (100 * $detail->get_mark) / $subject->total_mark;
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
            Cart::instance($cartName)->add([
               'id' => $detail->subject_id,
               'name' => $subject->name,
               'qty' => 1,
               'price' => $detail->get_mark,
               'options' => ['subject' => $subject, 'grade' => $grade, 'gradePoint' => $gradePoint, 'getMarkPercentage' => $getMarkPercentage],
           ]);
        }
        $addedList = Cart::instance($cartName)->content();
        //dd($addedList);
        $student = Student::find($result->student_id);
        $term = Term::find($result->term_id);

        $subjectList = Subject::pluck('name', 'id');

        return view('result.edit', compact('addedList', 'resultId', 'student', 'term', 'subjectList'));
    }

    public function removeOneSubjectEdit($resultId, $key)
    {
        //return $resultId.' '.$key;
        $cartName = $this->_resultEditCart.$resultId;
        Cart::instance($cartName)->remove($key);
        $addedList = Cart::instance($cartName)->content();
        flash()->warning('One subject is removed from List.');

        $subjectList = Subject::pluck('name', 'id');

        return view('result._partial_edit', compact('addedList', 'resultId', 'subjectList'));
    }

    public function addToCartEdit(Request $request)
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
        $cartName = $this->_resultEditCart.$request->result_id;
        $cartSubjects = Cart::instance($cartName)->content();
        foreach($cartSubjects as $cartSubject) {

            //echo $cartSubject->id;
            if($cartSubject->id == $request->subject_id){

                flash()->error('This Subject is Already Exist.');
                return redirect()->back();
            }
        }
        //return null;
        //count($subject->id);
        Cart::instance($cartName)->add([
                                                   'id' => $request->subject_id,
                                                   'name' => $subject->name,
                                                   'qty' => 1,
                                                   'price' => $request->get_mark,
                                                   'options' => ['subject' => $subject, 'grade' => $grade, 'gradePoint' => $gradePoint, 'getMarkPercentage' => $getMarkPercentage],
                                               ]);
        //return $c = Cart::instance($cartName)->content();
        return redirect('result/add-to-cart-edit');
        //return view('result.edit', compact('addedList', 'resultId', 'student', 'term', 'subjectList'));
    }
}
