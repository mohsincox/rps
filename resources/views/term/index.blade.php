@extends('layouts.app')

@section('content')

    <h1>
        <i class="fa fa-list-ul"></i>
        Term List

        <a href="{{ url('term/create') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Add Term
        </a>
    </h1>
    <hr>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($terms as $term)
            <tr>
                <td>{{ $term->id }}</td>
                <td>{{ $term->name }}</td>
                <td>{!! Html::link("term/$term->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success']) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection