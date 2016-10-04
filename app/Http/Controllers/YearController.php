<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

use App\Http\Requests\YearRequest;

class YearController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $years = Year::get();

        return view('year.index', compact('years'));
    }

    public function create()
    {
        return view('year.create');
    }

    public function store(YearRequest $request)
    {
        $year = Year::create($request->all());

        flash()->message($year->year . ' Successfully Created');

        return redirect('year');
    }

    public function edit($id)
    {
        $year = Year::find($id);

        return view('year.edit', compact('year'));
    }

    public function update(YearRequest $request, $id)
    {
        $year = Year::find($id);
        $year->update($request->all());

        flash()->message($year->year . ' Successfully Updated');

        return redirect('year');
    }
}
