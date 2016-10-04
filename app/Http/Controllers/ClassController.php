<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ClassRequest;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $classes = Classes::get();
        return view('class.index', compact('classes'));
    }

    public function create()
    {
        return view('class.create');
    }

    public function store(ClassRequest $request)
    {
        $class = Classes::create($request->all());

        flash()->message($class->name . ' Successfully Created');

        return redirect('class');
    }

    public function edit($id)
    {
        $class = Classes::find($id);

        return view('class.edit', compact('class'));
    }

    public function update(ClassRequest $request, $id)
    {
        $class = Classes::find($id);
        $class->update($request->all());

        flash()->message('Successfully Updated');

        return redirect('class');
    }
}
