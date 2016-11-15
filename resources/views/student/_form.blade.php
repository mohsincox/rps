@if(isset($student))
    {!! Form::model($student, ['url' => "student/$student->id", 'method' => 'put', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
@else
    {!! Form::open(['url' => 'student', 'method' => 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
@endif
<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Student Name', 'autocomplete' => 'off', 'required']) !!}
        <span class="help-block text-danger">
			    {{ $errors->first('name') }}
		    </span>
    </div>
</div>
<div class="required form-group {{ $errors->has('roll_no') ? 'has-error' : ''}}">
    {!! Form::label('roll_no', 'Roll No.', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::number('roll_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Roll No.', 'autocomplete' => 'off', 'required']) !!}
        <span class=" help-block text-danger">
			    {{ $errors->first('roll_no') }}
		    </span>
    </div>
</div>
<div class="required form-group {{ $errors->has('level_id') ? 'has-error' : ''}}">
    {!! Form::label('level_id', 'Select Class', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::select('level_id', $classList, null, ['class' => 'form-control', 'placeholder' => 'Select Class', 'autocomplete' => 'off', 'required']) !!}
        <span class="help-block text-danger">
			    {{ $errors->first('level_id') }}
		    </span>
    </div>
</div>
<div class="required form-group {{ $errors->has('section_id') ? 'has-error' : ''}}">
    {!! Form::label('section_id', 'Select Section', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::select('section_id', $sectionList, null, ['class' => 'form-control', 'placeholder' => 'Select Section', 'autocomplete' => 'off', 'required']) !!}
        <span class="help-block text-danger">
			    {{ $errors->first('section_id') }}
		    </span>
    </div>
</div>
<div class="required form-group {{ $errors->has('year_id') ? 'has-error' : ''}}">
    {!! Form::label('year_id', 'Select year', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::select('year_id', $yearList, null, ['class' => 'form-control', 'placeholder' => 'Select Year', 'autocomplete' => 'off', 'required']) !!}
        <span class="help-block text-danger">
			    {{ $errors->first('year_id') }}
		    </span>
    </div>
</div>
<div class="form-group {{ $errors->has('father_name') ? 'has-error' : ''}}">
    {!! Form::label('father_name', "Father's Name", ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('father_name', null, ['class' => 'form-control', 'placeholder' => "Enter Father's Name", 'autocomplete' => 'off']) !!}
        <span class="help-block text-danger">
			    {{ $errors->first('father_name') }}
		    </span>
    </div>
</div>
<div class="form-group {{ $errors->has('mother_name') ? 'has-error' : ''}}">
    {!! Form::label('mother_name', "Mother's Name", ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('mother_name', null, ['class' => 'form-control', 'placeholder' => "Enter Mother's Name", 'autocomplete' => 'off']) !!}
        <span class="help-block text-danger">
			    {{ $errors->first('mother_name') }}
		    </span>
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Address', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'autocomplete' => 'off', 'rows' => 3]) !!}
        <span class="help-block text-danger">
			    {{ $errors->first('address') }}
		    </span>
    </div>
</div><div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::file('image', ['class' => 'form-control',  'onchange' => 'readURL(this)', 'placeholder' => 'Enter Address', 'autocomplete' => 'off']) !!}
        <span class="help-block text-danger">
            {{ $errors->first('image') }}
        </span>
        <div>
            {{ Html::image('#', 'your image',['id' => 'blah']) }}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>