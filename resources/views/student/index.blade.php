@extends('layouts.app')

@section('content')

    <h1>
        <i class="fa fa-list-ul"></i>
        Students List

        <a href="{{ url('student/create') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Add Student
        </a>
    </h1>

    <hr>
    <table  id="data-table-search" cellspacing="0" width="100%" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SL</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Roll No.</th>
            <th>Class</th>
            <th>Section</th>
            <th>Year</th>
            <th>Father's Name</th>
            <th>Mother's Name</th>
            <th>Address</th>
            <th>Image</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
            ?>

            @foreach($students as $key=>$student)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><strong>{{ $student->id }}</strong></td>
                    <td><strong>{{  $student->name  }}</strong></td>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->level->name }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>{{ $student->year->year }}</td>
                    <td>{{ $student->father_name }}</td>
                    <td>{{ $student->mother_name }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ Html::image('uploads/'.$student->image, 'alt', ['width' => 70, 'height' => 70]) }}</td>
                    <td>{!! Html::link("student/$student->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success']) !!}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{--{{ $students->render() }}--}}


@endsection

@section('script')
    {!! Html::script('js/data_table_search.js') !!}
@endsection

