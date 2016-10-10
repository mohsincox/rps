<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $subjects = Subject::get();

        return view('subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(SubjectRequest $request)
    {
        $totalPercentage = ($request->total_mark * 100) / $request->total_mark;
        $passPercentage = ($request->pass_mark * 100) / $request->total_mark;
        $subject = Subject::create([
                                       'name' => $request->name,
                                       'total_mark' => $request->total_mark,
                                       'total_mark_in_percentage' => $totalPercentage,
                                       'pass_mark' => $request->pass_mark,
                                       'pass_mark_in_percentage' => $passPercentage
                                   ]);
        flash()->message($subject->name . ' Successfully Stored.');

        return redirect('subject');
    }

    public function edit($id)
    {
        $subject = Subject::find($id);

        return view('subject.edit', compact('subject'));
    }

    public function update(SubjectRequest $request, $id)
    {
        $totalPercentage = ($request->total_mark * 100) / $request->total_mark;
        $passPercentage = ($request->pass_mark * 100) / $request->total_mark;
        $subject = Subject::find($id);
        $subject->update([
                             'name' => $request->name,
                             'total_mark' => $request->total_mark,
                             'total_mark_in_percentage' => $totalPercentage,
                             'pass_mark' => $request->pass_mark,
                             'pass_mark_in_percentage' => $passPercentage
                         ]);
        flash()->message($subject->name . ' Successfully Updated.');

        return redirect('subject');
    }
}
