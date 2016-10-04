@if(isset($section))
    {!! Form::model($section, ['url' => "section/$section->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'section', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Section Name', 'autocomplete' => 'off', 'required']) !!}
        <span class="text-danger">
			    {{ $errors->first('name') }}
		    </span>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}