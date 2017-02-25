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
                        {!! Form::select('subject_id', $subjectList, null, ['id' => 'subject-id', 'class' => 'form-control chosen', 'placeholder' => 'Select Subject', 'required']) !!}
                        <span class="help-block text-danger">
                            {{ $errors->first('subject_id') }}
                        </span>
                    </div>
                </div>
                <div class="required form-group" {{ $errors->has('get_mark') ? 'has-error' : '' }}>
                    {!! Form::label('get_mark', 'Get Mark', ['class' => 'control-label col-sm-12']) !!}
                    <div class="col-sm-12">
                        {!! Form::number('get_mark', null, ['id' => 'get-mark', 'class' => 'form-control', 'placeholder' => 'Enter Get Mark', 'step' => 'any', 'required']) !!}
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
                                              'class'     => 'btn btn-primary add-cart-item-createe',
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
                            <button type="button" id="student_id_search" data-url="{{url('/result/student-name-show')}}" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>
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
            <div class="required form-group" {{ $errors->has('term_id') ? 'has-error' : '' }}>
                {!! Form::label('term_id', 'Select Term', ['class' => 'control-label col-sm-12']) !!}
                <div class="col-sm-12">
                    {!! Form::select('term_id', $termList, null, ['class' => 'form-control chosen', 'placeholder' => 'Select Term', 'required']) !!}
                    <span class="help-block text-danger">
                        {{ $errors->first('term_id') }}
                    </span>
                </div>
            </div>
        </div>

        <span id="result-info-create">
            @include('result._partial_create')
        </span>
        {!! Form::close() !!}
    </div>
@endsection

@section('script')
    {!! Html::script('js/search_id.js') !!}
@endsection