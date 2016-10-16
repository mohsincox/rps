@extends('layouts.app')

@section('content')
    <h1>
        <i class="fa fa-file-text-o"></i>
        Result Details
    </h1>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <td>Student Name:</td>
                    <th>{{ $result->student->name }}</th>
                </tr>
                <tr>
                    <td>Class:</td>
                    <th>{{ $result->student->level->name }}</th>
                </tr>
                <tr>
                    <td>Section</td>
                    <th>{{ $result->student->section->name }}</th>
                </tr>
                <tr>
                    <td>Father's Name</td>
                    <th>{{ $result->student->father_name }}</th>
                </tr>
                <tr>
                    <td>Mother's Name</td>
                    <th>{{ $result->student->mother_name }}</th>
                </tr>
                <tr>
                    <td>Address</td>
                    <th>{{ $result->student->address }}</th>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <div class="pull-right">
                {{ Html::image('/uploads/' . $result->student->image, 'alt', ['width' => 150, 'height' => 150]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject Name</th>
                    <th>Total Mark</th>
                    <th>Pass Mark</th>
                    <th>Get Mark</th>
                    <th>Grade Point</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resultDetails as $details)
                    <tr>
                        <td>{{ $details->id }}</td>
                        <td>{{ $details->subject->name }}</td>
                        <td>{{ $details->subject->total_mark }}</td>
                        <td>{{ $details->subject->pass_mark }}</td>
                        <td>{{ $details->get_mark }}</td>
                        <td>Grade Point</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection