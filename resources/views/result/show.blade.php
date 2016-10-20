@extends('layouts.app')

@section('content')
    <h1>
        <i class="fa fa-file-text-o"></i>
        Result Details
    </h1>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-borderless table-striped table-hover ">
                <tr>
                    <td style="border: 0;">Student Name:</td>
                    <th style="border: 0;">{{ $result->student->name }}</th>
                </tr>
                <tr style="border: 0;">
                    <td>Class:</td>
                    <th>{{ $result->student->level->name }}</th>
                </tr>
                <tr>
                    <td>Section</td>
                    <th>{{ $result->student->section->name }}</th>
                </tr>
                <tr>
                    <td>Father's Name</td>
                    <th>{{ $result->student->father_name }}</th>
                </tr>
                <tr>
                    <td>Mother's Name</td>
                    <th>{{ $result->student->mother_name }}</th>
                </tr>
                <tr>
                    <td>Address</td>
                    <th>{{ $result->student->address }}</th>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <div class="pull-right">
                {{ Html::image('/uploads/' . $result->student->image, 'alt', ['width' => 150, 'height' => 150]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    {{--<th>ID</th>--}}
                    <th>SL</th>
                    <th>Subject Name</th>
                    <th>Total Mark</th>
                    <th>Pass Mark</th>
                    <th>Get Mark</th>
                    <th>Get Mark in %</th>
                    <th>Grade Point</th>
                    <th>Grade</th>
                    <th>Grade Point Average</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $i = 0;
                    $print = true;
                    $totalPoint = $result->total_point;
                        //return $rD = count($resultDetailsBySubject);
                ?>
                @foreach($resultDetailsBySubject as $details)
                    @if($details->resultDetails->first()->get_mark < $details->pass_mark)
                    <tr style="background-color: red;">
                        {{--<td>{{ $details->id }}</td>--}}
                        <td>{{ ++$i }}</td>
                        <td>{{ $details->name }}</td>
                        <td>{{ $details->total_mark }}</td>
                        <td>{{ $details->pass_mark }}</td>
                        <td><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>
                        <td>{{ $details->resultDetails->first()->get_mark_percentage or 'Absent' }}</td>
                        <td>{{ $details->resultDetails->first()->grade_point or 'Absent' }}</td>
                        <td>{{ $details->resultDetails->first()->grade or 'Absent' }}</td>
                        @if($print)
                            <td rowspan="11"  style="vertical-align: middle;text-align: center; background-color: white">
                                {{--{{ round($totalPoint/11, 2, PHP_ROUND_HALF_UP) }}--}} <strong style="color: red;">Fail</strong>
                            </td>
                            @php
                                $print = false;
                            @endphp
                        @endif
                    </tr>



                    @elseif($details->resultDetails == '')
                        jtgdgi
                        {{--<tr style="background-color: yellow;">--}}
                            {{--<td>{{ $details->id }}</td>--}}
                            {{--<td>{{ ++$i }}</td>--}}
                            {{--<td>{{ $details->name }}</td>--}}
                            {{--<td>{{ $details->total_mark }}</td>--}}
                            {{--<td>{{ $details->pass_mark }}</td>--}}
                            {{--<td><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>--}}
                            {{--<td>{{ $details->resultDetails->first()->get_mark_percentage or 'Absent' }}</td>--}}
                            {{--<td>{{ $details->resultDetails->first()->grade_point or 'Absent' }}</td>--}}
                            {{--<td>{{ $details->resultDetails->first()->grade or 'Absent' }}</td>--}}
                            {{--@if($print)--}}
                                {{--<td rowspan="11"  style="vertical-align: middle;text-align: center; background-color: white">--}}
                                    {{--{{ round($totalPoint/11, 2, PHP_ROUND_HALF_UP) }} <strong style="color: red;">Fail</strong>--}}
                                {{--</td>--}}
                                {{--@php--}}
                                {{--$print = false;--}}
                                {{--@endphp--}}
                            {{--@endif--}}
                        {{--</tr>--}}



                    @else
                        <tr>
                            {{--<td>{{ $details->id }}</td>--}}
                            <td>{{ ++$i }}</td>
                            <td>{{ $details->name }}</td>
                            <td>{{ $details->total_mark }}</td>
                            <td>{{ $details->pass_mark }}</td>
                            <td><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>
                            <td>{{ $details->resultDetails->first()->get_mark_percentage or 'Absent' }}</td>
                            <td>{{ $details->resultDetails->first()->grade_point or 'Absent' }}</td>
                            <td>{{ $details->resultDetails->first()->grade or 'Absent' }}</td>
                            @if($print)
                                <td rowspan="11"  style="vertical-align: middle;text-align: center;">
                                    {{ round($totalPoint/11, 2, PHP_ROUND_HALF_UP) }}
                                </td>
                                @php
                                $print = false;
                                @endphp
                            @endif
                        </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection