<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\Year;
use Illuminate\Http\Request;

use App\Http\Requests;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $students = Student::get();

        return view('student.index', compact('students'));
    }

    public function create()
    {
        $classList = Classes::lists('name', 'id');
        $sectionList = Section::lists('name', 'id');
        $yearList = Year::lists('year', 'id');

        return view('student.create', compact('classList', 'sectionList', 'yearList'));
    }

    public function store()
    {

    }
}
