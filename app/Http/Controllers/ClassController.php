<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Level;
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
        $classes = Level::get();
        return view('class.index', compact('classes'));
    }

    public function create()
    {
        return view('class.create');
    }

    public function store(ClassRequest $request)
    {
        $class = Level::create($request->all());

        flash()->message($class->name . ' Successfully Created');

        return redirect('class');
    }

    public function edit($id)
    {
        $class = Level::find($id);

        return view('class.edit', compact('class'));
    }

    public function update(ClassRequest $request, $id)
    {
        $class = Level::find($id);
        $class->update($request->all());

        flash()->message('Successfully Updated');

        return redirect('class');
    }
}
