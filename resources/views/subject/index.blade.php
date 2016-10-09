@extends('layouts.app')

@section('content')

    <h1>
        <i class="fa fa-list-ul"></i>
        Subject List

        <a href="{{ url('subject/create') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Add Subject
        </a>
    </h1>
    <hr>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Total Mark</th>
            <th>Pass Mark</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->id }}</td>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->total_mark }}</td>
                <td>{{ $subject->pass_mark }}</td>
                <td>{!! Html::link("subject/$subject->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success']) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection