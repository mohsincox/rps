@extends('layouts.app')

@section('content')
    <style>
        @media print
        {
            .print-margin{
                margin-top: 200px;
            }
            #pager,
            form,
            .no-print
            {
                display: none !important;
                height: 0;
            }


            .no-print, .no-print *{
                display: none !important;
                height: 0;
            }
        }
    </style>
    <div class="print-margin">
    <h1>
        <i class="fa fa-file-text-o"></i>
        Student Information & Result Details
    </h1>
    <hr>
    <div class="row">
        <div class="col-xs-6">
            <table class="table">
                <tr>
                    <td style="border: 0;">Student Name:</td>
                    <td style="border: 0;"><strong>{{ $result->student->name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Class:</td>
                    <td  style="border: 0;"><strong>{{ $result->student->level->name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Section</td>
                    <td style="border: 0;"><strong>{{ $result->student->section->name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Father's Name</td>
                    <td style="border: 0;"><strong>{{ $result->student->father_name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Mother's Name</td>
                    <td style="border: 0;"><strong>{{ $result->student->mother_name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Address</td>
                    <td style="border: 0;"><strong>{{ $result->student->address }}</strong></td>
                </tr>
            </table>
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                {{ Html::image('/uploads/' . $result->student->image, 'alt', ['width' => 150, 'height' => 150]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
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
                        <th>GPA</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 0;
                ?>
                @foreach($resultDetailsBySubject as  $details)
                    @if(!count($details->resultDetails))
                        <tr style="background-color: yellow;">
                            <td>{{ ++$i }}</td>
                            <td>{{ $details->name }}</td>
                            <td>{{ $details->total_mark }}</td>
                            <td>{{ $details->pass_mark }}</td>
                            <td><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>
                            <td>{{ $details->resultDetails->first()->get_mark_percentage or 'Absent' }}</td>
                            <td>{{ $details->resultDetails->first()->grade_point or 'Absent' }}</td>
                            <td>{{ $details->resultDetails->first()->grade or 'Absent' }}</td>

                            @if($i == 1)
                                <td style="vertical-align: middle; text-align: center; background-color: white; color: gray;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalResult }}</strong></td>
                            @endif
                        </tr>
                    @else
                        @if($details->resultDetails->first()->get_mark < $details->pass_mark)
                            <tr style="background-color: red; color: white">
                                <td>{{ ++$i }}</td>
                                <td>{{ $details->name }}</td>
                                <td>{{ $details->total_mark }}</td>
                                <td>{{ $details->pass_mark }}</td>
                                <td><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>
                                <td>{{ $details->resultDetails->first()->get_mark_percentage or 'Absent' }}</td>
                                <td>{{ $details->resultDetails->first()->grade_point or 'Absent' }}</td>
                                <td>{{ $details->resultDetails->first()->grade or 'Absent' }}</td>
                                @if($i==1)
                                    <td style="vertical-align: middle; text-align: center; background-color: white; color: black;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalResult }}</strong></td>
                                @endif
                            </tr>

                        @else
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $details->name }}</td>
                                <td>{{ $details->total_mark }}</td>
                                <td>{{ $details->pass_mark }}</td>
                                <td><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>
                                <td>{{ $details->resultDetails->first()->get_mark_percentage or 'Absent' }}</td>
                                <td>{{ $details->resultDetails->first()->grade_point or 'Absent' }}</td>
                                <td>{{ $details->resultDetails->first()->grade or 'Absent' }}</td>
                                @if($i==1)
                                    <td style="vertical-align: middle; text-align: center; background-color: white;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalResult }}</strong></td>
                                @endif
                            </tr>
                        @endif
                    @endif
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>
    <input type="button" class="no-print" value="Print this page" onClick="window.print()">
@endsection