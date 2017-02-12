@extends('layouts.app')

@section('content')
    <style>
        @media print
        {
            .print-margin{
                margin-top: 0px;
                font-size: 20pt;
            }
            #pager,
            form,
            .no-print
            {
                display: none !important;
                height: 0;
            }


            .no-print, .no-print *{
                display: none !important;
                height: 0;
            }
        }
    </style>
    <div class="row">
        <div class="col-xs-2">
            <div class="pull-left">
                {{ Html::image('/images/logo.jpg', 'alt', ['width' => 150, 'height' => 150]) }}
            </div>
        </div>
        <div class="col-xs-9">
            <h1><center>Bara Moheshkhali Girls' High School</center></h1>
            <center><h3>
                    <i class="fa fa-file-text-o"></i>
                    Annual Examination Result
                </h3></center>
        </div>
    </div>
    <div class="print-margin">
        <h2>Class: {{ $results[0]->student->level->name }}</h2>
        <h2>Year: {{ $results[0]->student->year->year }}</h2>
        <h2>Term: {{ $results[0]->term->name }}</h2>
        <h2>Fail in {{ $results[0]->fail_subject }} Subject(s)</h2>

        <hr>
        <table id="data-table-search" cellspacing="0" width="100%" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>Present Roll</th>
                <th>Student Name</th>
                <th>Ex Roll</th>
                <th>Section</th>
                <th>Total Marks</th>
                <th>Fail Subject(s)</th>
                {{--<th>GPA</th>--}}
                {{--<th>Result</th>--}}
                {{--<th>View</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($results as $key=>$result)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $result->student->name }}</td>
                    <td>{{ $result->student->roll_no }}</td>
                    <td>{{ $result->student->section->name }}</td>
                    <td>{{ $result->total_get_mark }}</td>
                    <td>{{ $result->fail_subject }}</td>
                    {{--@if($result->grade_point_avg == 0.00)--}}
                        {{--<td>Failed</td>--}}
                        {{--<td>Failed</td>--}}
                    {{--@else--}}
                        {{--<td>{{ $result->grade_point_avg }}</td>--}}
                        {{--<td>Passed</td>--}}
                    {{--@endif--}}
                    {{--<td>{!! Html::link("result/$result->id",' View', ['class' => 'fa fa-eye btn btn-success']) !!}</td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <small>Software Developed by <strong>Mohsin Iqbal</strong></small>
    <input type="button" class="no-print btn btn-primary" value="Print this page" onClick="window.print()">
@endsection

@section('script')
    {!! Html::script('js/data_table_search.js') !!}
@endsection