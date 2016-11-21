@extends('layouts.app')

@section('content')
    <h3>Class {{ $results[0]->student->level->name }}</h3>
    <h3>Section {{ $results[0]->student->section->name }}</h3>
    <h3>Year {{ $results[0]->student->year->year }}</h3>
    <h3>Term {{ $results[0]->term->name }}</h3>

    <hr>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SL</th>
            <th>Student Name</th>
            <th>Roll No.</th>
            <th>GPA</th>
            <th>Result</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $key=>$result)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $result->student->name }}</td>
                <td>{{ $result->student->roll_no }}</td>
                @if($result->grade_point_avg == 0.00)
                    <td>Failed</td>
                    <td>Failed</td>
                @else
                    <td>{{ $result->grade_point_avg }}</td>
                    <td>Passed</td>
                @endif
                <td>{!! Html::link("result/$result->id",' View', ['class' => 'fa fa-eye btn btn-success']) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection