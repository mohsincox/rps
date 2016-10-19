@extends('layouts.app')

@section('content')

    <h1>
        <i class="fa fa-list-ul"></i>
        Results List

        <a href="{{ url('result/create') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Create Result
        </a>
    </h1>
    <hr>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Student Id</th>
            <th>Student Name</th>
            <th>Roll No</th>
            <th>Class</th>
            <th>Section</th>
            <th>Term</th>
            <th>Year</th>
            <th>Total Point</th>
            <th>Grade Point Avg</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $result)
            <tr>
                <td>{{ $result->id }}</td>
                <td>{{ $result->student_id }}</td>
                <td>{{ $result->student->name }}</td>
                <td>{{ $result->student->roll_no }}</td>
                <td>{{ $result->student->level->name }}</td>
                <td>{{ $result->student->section->name }}</td>
                <td>{{ $result->term->name }}</td>
                <td>{{ $result->year->year }}</td>
                <td>{{ $result->total_point }}</td>
                <td>{{ $result->total_point/11 }}</td>
                <td>{!! Html::link("result/$result->id",' View', ['class' => 'fa fa-eye btn btn-success']) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection