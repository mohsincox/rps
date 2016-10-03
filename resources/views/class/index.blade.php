@extends('layouts.app')

@section('content')

        <h1>
            <i class="fa fa-list-ul"></i>
            Classes List

            <a href="{{ url('class/create') }}" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> Add Class
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
            @foreach($classes as $class)
                <tr>
                    <td>{{ $class->id }}</td>
                    <td>{{ $class->name }}</td>
                    <td>{!! Html::link("class/$class->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success']) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

@endsection