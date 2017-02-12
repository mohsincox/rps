@extends('layouts.app')

@section('content')
    <p>Student Id: <b>{{ $student->id }}</b></p>
    <p>Student Name: <b>{{ $student->name }}</b></p>
    <p>Student Roll No.: <b>{{ $student->roll_no }}</b></p>
    <p>Term: <b>{{ $term->name }}</b></p>
    <p>Result Id: <b>{{ $resultId }}</b></p>
    <span id="result-info">
         @include('result._partial_edit')
    </span>

@endsection()

@section('script')
    {!! Html::script('js/delete_cart_item.js') !!}
@endsection