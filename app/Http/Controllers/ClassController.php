<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ClassController extends Controller
{
    public function index()
    {
        return 'test';
    }

    public function create()
    {
        return view('class.create');
    }
}
