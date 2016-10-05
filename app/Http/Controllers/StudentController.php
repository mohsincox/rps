<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Section;
use App\Models\Student;
use App\Models\Year;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $students = Student::with(['level', 'section', 'year'])->get();
        //dd($students);
       //return $students;
        return view('student.index', compact('students'));
    }

    public function create()
    {
        $classList = Level::pluck('name', 'id');
        $sectionList = Section::pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');

        return view('student.create', compact('classList', 'sectionList', 'yearList'));
    }

    public function store(StudentRequest $request)
    {
        //return $request->all();
        if ($request->image == '') {
            $student = Student::create(
                [
                    'name' => $request->name,
                    'roll_no' => $request->roll_no,
                    'level_id' => $request->level_id,
                    'section_id' => $request->section_id,
                    'year_id' => $request->year_id,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'address' => $request->address,
                    'image' => $request->image
                ]
            );
        } else {

            if (Input::file('image')->isValid()) {
                $destinationPath = 'uploads';
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;
                Input::file('image')->move($destinationPath, $fileName);
            } else {
                flash()->error('uploaded file is not valid');

                return redirect()->back();
        }

        $student = Student::create(
            [
                'name' => $request->name,
                'roll_no' => $request->roll_no,
                'level_id' => $request->level_id,
                'section_id' => $request->section_id,
                'year_id' => $request->year_id,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'address' => $request->address,
                'image' => $fileName
            ]
        );
    }
        flash()->message($student->name . ' Successfully Created');

        return redirect('student');
    }

    public function edit($id)
    {
        $student = Student::find($id);

    }
}
