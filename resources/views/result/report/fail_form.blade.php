@extends('layouts.app')

@section('content')
    {!! Form::open(['url' => 'result/show-result-fail', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form' ]) !!}

    <div class="required form-group" {{ $errors->has('level_id') ? 'has-error' : '' }}>
        {!! Form::label('level_id', 'Select Class', ['class' => 'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::select('level_id', $classList, null, ['class' => 'form-control', 'placeholder' => 'Select Class', 'id' => '', 'required']) !!}
            <span class="help-block text-danger">
                {{ $errors->first('level_id') }}
            </span>
        </div>
    </div>

    <div class="required form-group" {{ $errors->has('section_id') ? 'has-error' : '' }}>
        {!! Form::label('section_id', 'Select Term', ['class' => 'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::select('section_id', $sectionList, null, ['class' => 'form-control', 'placeholder' => 'Select Section', 'required']) !!}
            <span class="help-block text-danger">
                {{ $errors->first('section_id') }}
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

    <div class="required form-group" {{ $errors->has('term_id') ? 'has-error' : '' }}>
        {!! Form::label('term_id', 'Select Term', ['class' => 'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::select('term_id', $termList, null, ['class' => 'form-control', 'placeholder' => 'Select Term', 'required']) !!}
            <span class="help-block text-danger">
                {{ $errors->first('term_id') }}
            </span>
        </div>
    </div>

    <div class="required form-group {{ $errors->has('fail_subject') ? 'has-error' : ''}}">
        {!! Form::label('fail_subject', 'Fail Subject(s)', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::number('fail_subject', null, ['class' => 'form-control', 'placeholder' => 'Enter Fail Subject(s)', 'autocomplete' => 'off', 'required']) !!}
            <span class="text-danger">
			    {{ $errors->first('fail_subject') }}
		    </span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@endsection