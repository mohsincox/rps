@extends('layouts.app')

@section('content')
    <h1>
        <i class="fa fa-file-text-o"></i>
        Result Registration
    </h1>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            {!! Form::open(['url' => 'result/add-to-cart', 'method' => 'post', 'class' => 'form-horizontal']) !!}
            <div class="required form-group" {{ $errors->has('subject_id') ? 'has-error' : '' }}>
                {!! Form::label('subject_id', 'Select Subject', ['class' => 'control-label col-sm-3']) !!}
                <div class="col-sm-9">
                    {!! Form::select('subject_id', $subjectList, null, ['class' => 'form-control', 'placeholder' => 'Select Subject', 'required']) !!}
                    <span class="help-block text-danger">
                        {{ $errors->first('subject_id') }}
                    </span>
                </div>
            </div>
            <div class="required form-group" {{ $errors->has('get_mark') ? 'has-error' : '' }}>
                {!! Form::label('get_mark', 'Get Mark', ['class' => 'control-label col-sm-3']) !!}
                <div class="col-sm-9">
                    {!! Form::number('get_mark', null, ['class' => 'form-control', 'placeholder' => 'Enter Get Mark', 'id' => 'get_mark', 'step' => 'any', 'required']) !!}
                    <span class="help-block text-danger" style="color: red">
                        {{ $errors->first('get_mark') }}
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>



        <div class="col-sm-6">
            <div>
                {!! Form::open(['url' => 'result/save-cart', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form' ]) !!}

                <div class="required form-group" {{ $errors->has('student_id') ? 'has-error' : '' }}>
                    {!! Form::label('student_id', 'Select Student', ['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('student_id', $studentList, null, ['class' => 'form-control', 'placeholder' => 'Select Student', 'id' => '', 'required']) !!}
                        <span class="help-block text-danger">
                            {{ $errors->first('student_id') }}
                        </span>
                    </div>
                </div>

                <div class="required form-group" {{ $errors->has('term_id') ? 'has-error' : '' }}>
                    {!! Form::label('term_id', 'Select Term', ['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('term_id', $termList, null, ['class' => 'form-control', 'placeholder' => 'Select Term', 'required']) !!}
                        <span class="help-block text-danger">
                            {{ $errors->first('term_id') }}
                        </span>
                    </div>
                </div>

                <div class="required form-group" {{ $errors->has('year_id') ? 'has-error' : '' }}>
                    {!! Form::label('year_id', 'Select Year', ['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('year_id', $yearList, null, ['class' => 'form-control', 'placeholder' => 'Select Year', 'required']) !!}
                        <span class="help-block text-danger">
                            {{ $errors->first('year_id') }}
                        </span>
                    </div>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>SL</th>
                        {{--<th>Ledger Id</th>--}}
                        <th>Subject Name</th>
                        {{--<th>Quantity</th>--}}
                        <th>Marks</th>
                        {{--<th>Sub Total</th>--}}
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($addedList as $key=>$item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            {{--<td>{{$item->id }}</td>--}}
                            <td>{{ $item->name }}</td>
                            {{--<td>{{ $item->qty }}</td>--}}
                            <td>{{ $item->price }}</td>
                            {{--<td>{{ $item->subtotal }}</td>--}}
                            <td style=""><a class="btn btn-danger btn-xs" href="{!! url('result/remove-list/'. $key) !!}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
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
                        {{ Html::link('result/clear-all-lists', 'Clear', ['class' => 'btn btn-danger fa fa-times']) }}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection