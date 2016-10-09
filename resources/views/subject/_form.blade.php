@if(isset($subject))
    {!! Form::model($subject, ['url' => "subject/$subject->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'subject', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Subject Name', 'autocomplete' => 'off', 'required']) !!}
        <span class="text-danger">
			    {{ $errors->first('name') }}
		    </span>
    </div>
</div>
<div class="required form-group {{ $errors->has('total_mark') ? 'has-error' : ''}}">
    {!! Form::label('total_mark', 'Total Mark', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::number('total_mark', null, ['class' => 'form-control', 'placeholder' => 'Enter Total Mark', 'autocomplete' => 'off', 'required', 'step' => 'any']) !!}
        <span class="text-danger">
			    {{ $errors->first('total_mark') }}
		    </span>
    </div>
</div>
<div class="required form-group {{ $errors->has('pass_mark') ? 'has-error' : ''}}">
    {!! Form::label('pass_mark', 'Pass Mark', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::number('pass_mark', null, ['class' => 'form-control', 'placeholder' => 'Enter Pass Mark', 'autocomplete' => 'off', 'required', 'step' => 'any']) !!}
        <span class="text-danger">
			    {{ $errors->first('pass_mark') }}
		    </span>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}