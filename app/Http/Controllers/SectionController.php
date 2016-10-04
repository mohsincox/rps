<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SectionRequest;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sections = Section::get();

        return view('section.index', compact('sections'));
    }

    public function create()
    {
        return view('section.create');
    }

    public function store(SectionRequest $request)
    {
        $section = Section::create($request->all());

        flash()->message($section->name . ' Successfully Created');

        return redirect('section');
    }

    public function edit($id)
    {
        $section = Section::find($id);

        return view('section.edit', compact('section'));
    }

    public function update(SectionRequest $request, $id)
    {
        $section = Section::find($id);
        $section->update($request->all());

        flash()->message($section->name . ' Successfully Updated');

        return redirect('section');
    }

}
