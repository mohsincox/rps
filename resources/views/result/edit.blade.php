@extends('layouts.app')

@section('content')

    <span id="result-info">
         @include('result._partial_edit')
    </span>

@endsection()

@section('script')
    {!! Html::script('js/delete_cart_item.js') !!}
@endsection