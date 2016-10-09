@if(isset($year))
    {!! Form::model($year, ['url' => "year/$year->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'year', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<div class="required form-group {{ $errors->has('year') ? 'has-error' : ''}}">
    {!! Form::label('year', 'Year', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::number('year', null, ['class' => 'form-control', 'placeholder' => 'Enter Year', 'autocomplete' => 'off', 'required']) !!}
        <span class="text-danger">
			    {{ $errors->first('year') }}
		    </span>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}