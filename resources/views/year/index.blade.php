@extends('layouts.app')

@section('content')

    <h1>
        <i class="fa fa-list-ul"></i>
        Years List

        <a href="{{ url('year/create') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Add Year
        </a>
    </h1>
    <hr>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Year</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($years as $year)
            <tr>
                <td>{{ $year->id }}</td>
                <td>{{ $year->year }}</td>
                <td>{!! Html::link("year/$year->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success']) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection