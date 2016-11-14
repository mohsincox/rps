@extends('layouts.app')

@section('content')
    <h1>
        <i class="fa fa-file-text-o"></i>
        Result Registration
    </h1>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            {!! Form::open(['url' => 'result/add-to-cart', 'method' => 'post']) !!}
                <div class="required form-group" {{ $errors->has('subject_id') ? 'has-error' : '' }}>
                    {!! Form::label('subject_id', 'Select Subject', ['class' => 'control-label col-sm-12']) !!}
                    <div class="col-sm-12">
                        {!! Form::select('subject_id', $subjectList, null, ['class' => 'form-control chosen', 'placeholder' => 'Select Subject', 'required']) !!}
                        <span class="help-block text-danger">
                            {{ $errors->first('subject_id') }}
                        </span>
                    </div>
                </div>
                <div class="required form-group" {{ $errors->has('get_mark') ? 'has-error' : '' }}>
                    {!! Form::label('get_mark', 'Get Mark', ['class' => 'control-label col-sm-12']) !!}
                    <div class="col-sm-12">
                        {!! Form::number('get_mark', null, ['class' => 'form-control', 'placeholder' => 'Enter Get Mark', 'id' => 'get_mark', 'step' => 'any', 'required']) !!}
                        <span class="help-block text-danger" style="color: red">
                            {{ $errors->first('get_mark') }}
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-0">
                        {{--<i class="fa fa-plus"></i>--}}
                        {{--{!! Form::submit('Add Subject', ['class' => 'btn btn-primary']) !!}--}}
                        {!! Form::button('<i class="fa fa-plus"></i> Add Subject', [
                                              'class'     => 'btn btn-primary',
                                              'type'      => 'submit',
                                          ]) !!}
                    </div>

                </div>
            {!! Form::close() !!}


            {!! Form::open(['url' => 'result/save-cart', 'method' => 'post', 'class' => '', 'role' => '' ]) !!}


            <div class="required form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                {!! Form::label('student_id', 'Student ID', ['class' => 'col-sm-12 control-label']) !!}
                <div class="col-sm-12">
                    <div class="input-group required">
                        {!! Form::text('student_id',null, ['id' => 'student_id', 'class' =>'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter Student ID', 'required' => 'required' ]) !!}
                        <span class="input-group-btn">
                            <button type="button" id="student_id_search" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>
                    <span class="help-block text-danger">
                        {!! $errors->first('student_id') !!}
                    </span>
                </div>
            </div>

            <div>
                <span id="student_name_show"></span>
            </div>

            <div class="required form-group" {{ $errors->has('level_id') ? 'has-error' : '' }}>
                {!! Form::label('level_id', 'Select Class', ['class' => 'control-label col-sm-12']) !!}
                <div class="col-sm-12">
                    {!! Form::select('level_id', $classList, null, ['class' => 'form-control chosen', 'placeholder' => 'Select Class', 'id' => '', 'required']) !!}
                    <span class="help-block text-danger">
                            {{ $errors->first('level_id') }}
                        </span>
                </div>
            </div>

            <div class="required form-group" {{ $errors->has('term_id') ? 'has-error' : '' }}>
                {!! Form::label('term_id', 'Select Term', ['class' => 'control-label col-sm-12']) !!}
                <div class="col-sm-12">
                    {!! Form::select('term_id', $termList, null, ['class' => 'form-control chosen', 'placeholder' => 'Select Term', 'required']) !!}
                    <span class="help-block text-danger">
                            {{ $errors->first('term_id') }}
                        </span>
                </div>
            </div>

            <div class="required form-group" {{ $errors->has('year_id') ? 'has-error' : '' }}>
                {!! Form::label('year_id', 'Select Year', ['class' => 'control-label col-sm-12']) !!}
                <div class="col-sm-12">
                    {!! Form::select('year_id', $yearList, null, ['class' => 'form-control chosen', 'placeholder' => 'Select Year', 'required']) !!}
                    <span class="help-block text-danger">
                            {{ $errors->first('year_id') }}
                        </span>
                </div>
            </div>



        </div>



        <div class="col-sm-8">
            <div>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>SL</th>
                        {{--<th>Ledger Id</th>--}}
                        <th>Subject Name</th>
                        {{--<th>Quantity</th>--}}
                        <th>Marks</th>
                        <th>Mark Percentage</th>
                        <th>Grade</th>
                        <th>Grade Point</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=1;
                        $totalPoint = 0;
                    ?>
                    @foreach($addedList as $key=>$item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            {{--<td>{{$item->id }}</td>--}}
                            <td>{{ $item->name }}</td>
                            {{--<td>{{ $item->qty }}</td>--}}
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->options->getMarkPercentage }}</td>
                            <td>{{ $item->options->grade }}</td>
                            <td>{!! $item->options->gradePoint !!}</td>
                            <td style=""><a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal-{{ $key }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal-{{ $key }}" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">DELETE</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to delete <strong>{{ $item->name }}</strong> from the list?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            {{ Html::link('result/remove-one-subject/'. $key, 'Delete', ['class' => 'btn btn-danger']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $totalPoint = $totalPoint + $item->options->gradePoint;
                            ?>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <hr>
                    <div class="form-group col-sm-12">
                        {!! Form::button('<i class="fa fa-save"></i> Save', [
                                              'class'     => 'btn btn-success',
                                              'type'      => 'submit',
                                          ]) !!}
                        {{--{{ Html::link('result/clear-all-subjects', 'Clear', ['class' => 'btn btn-danger fa fa-times', 'style' => 'padding: 10px;']) }}--}}
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalClear"><i class="fa fa-times"></i> Clear</button>
                        <!-- Modal -->
                        <div class="modal fade" id="myModalClear" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">DELETE</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you want to delete <strong>All Subject(s)</strong> from the list?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        {{ Html::link('result/clear-all-subjects', 'Delete', ['class' => 'btn btn-danger']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! Html::script('js/search_id.js') !!}
@endsection