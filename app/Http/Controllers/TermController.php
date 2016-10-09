<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

use App\Http\Requests\TermRequest;

class TermController extends Controller
{
    public  function index()
    {
        $terms = Term::get();

        return view('term.index', compact('terms'));
    }

    public function create()
    {
        return view('term.create');
    }

    public function store(TermRequest $request)
    {
        $term = Term::create($request->all());

        flash()->message($term->name . ' Successfully Created');

        return redirect('term');
    }

    public function edit($id)
    {
        $term = Term::find($id);

        return view('term.edit', compact('term'));
    }

    public function update(TermRequest $request, $id)
    {
        $term = Term::find($id);
        $term->update($request->all());

        flash()->message($term->name . ' Successfully Updated.');

        return redirect('term');
    }
}
