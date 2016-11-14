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
use File;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $students = Student::with(['level', 'section', 'year'])
            ->orderBy('id', 'desc')
            ->paginate(3);
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
        $addedStudent = Student::where('roll_no', $request->roll_no)
                               ->where('level_id', $request->level_id)
                               ->where('section_id', $request->section_id)
                               ->get();
        if (!count($addedStudent)) {

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
        }
        else {
            flash()->error('This Student with Roll No. '. $request->roll_no . ' already in exist that Class and Section.');
            return redirect()->back();
        }
        return redirect('student');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $classList = Level::pluck('name', 'id');
        $sectionList = Section::pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');

        return view('student.edit', compact('student', 'classList', 'sectionList', 'yearList'));
    }

    public function update(StudentRequest $request, $id)
    {
        //return $request->all();
        $student = Student::find($id);
        $addedStudent = Student::where('roll_no', $request->roll_no)
                               ->where('level_id', $request->level_id)
                               ->where('section_id', $request->section_id)
                               ->where('id', '!=', $student->id)
                               ->get();
        //return count($addedStudent);

        if (!count($addedStudent)) {

            File::delete('uploads/' . $student->image);
            if ($request->image == '') {
                $student->update(
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
                $student->update(
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
        }
        else {
            flash()->error('This Student with Roll No. '. $request->roll_no . ' already in exist that Class and Section.');
            return redirect()->back();
        }
        flash()->message($student->name . ' Successfully Created');

        return redirect('student');
    }
}