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
    <table id="data-table-search" cellspacing="0" width="100%" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            {{--<th>ID</th>--}}
            <th>Student Id</th>
            <th>Student Name</th>
            <th>Roll No</th>
            <th>Class</th>
            <th>Section</th>
            <th>Term</th>
            <th>Year</th>
            {{--<th>Total Point</th>--}}
            <th>GPA</th>
            <th>Fail Subject(s)</th>
            <th>Result</th>
            <th>Total Marks</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $result)
            <tr>
                {{--<td>{{ $result->id }}</td>--}}
                <td><strong>{{ $result->student_id }}</strong></td>
                <td><strong>{{ $result->student->name }}</strong></td>
                <td>{{ $result->student->roll_no }}</td>
                <td>{{ $result->student->level->name }}</td>
                <td>{{ $result->student->section->name }}</td>
                <td>{{ $result->term->name }}</td>
                <td>{{ $result->student->year->year }}</td>
                {{--<td>{{ $result->total_point }}</td>--}}
                <td><strong>{{ round($result->total_point/11, 2, PHP_ROUND_HALF_UP) }}</strong></td>
                <td>{{ $result->fail_subject }}</td>
                <td><strong>{{ $result->result }}</strong></td>
                <td><strong>{{ $result->total_get_mark }}</strong></td>
                <td>{!! Html::link("result/$result->id",' View', ['class' => 'fa fa-eye btn btn-success btn-xs']) !!}</td>
                <td>{!! Html::link("result/$result->id/edit",' Edit', ['class' => 'fa fa-eye btn btn-success btn-xs']) !!}</td>
                <td><a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal-{{ $result->id }}">
                        <i class="fa fa-trash"></i> Delete
                    </a>
                </td>

                <!-- Modal -->
                <div class="modal fade" id="myModal-{{ $result->id }}" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">DELETE</h4>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to delete this Result?</p>
                            </div>
                            <div class="modal-footer">
                                {{--<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>--}}

                                {{ Form::open(['method' => 'DELETE', 'url' => "result/$result->id"]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@section('script')
    {!! Html::script('js/data_table_search.js') !!}
@endsection