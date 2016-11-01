@extends('layouts.app')

@section('content')
    <h3>Class {{ $results[0]->level->name }}</h3>
    <h3>Term {{ $results[0]->term->name }}</h3>
    <h3>Year {{ $results[0]->year->year }}</h3>

    <hr>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SL</th>
            <th>Student Name</th>
            <th>Result</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $key=>$result)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $result->student->name }}</td>
                <td>{{ $result->result }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection