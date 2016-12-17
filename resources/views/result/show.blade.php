@extends('layouts.app')

@section('content')
    <style>
        .table-bordered>tbody>tr>td.absent {
            /*background-color: #ffffcc !important;*/
            color: green;
        }
        .table-bordered>tbody>tr>td.fail {
            /*background-color: red !important;*/
            color: red;
        }
        @media print
        {
            /*.table-bordered>tbody>tr>td.absent {*/
                /*background-color: #ffff80 !important;*/
            /*}*/
            .print-margin{
                margin-top: 0px;
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
        <div class="row">
            <div class="col-xs-2">
                <div class="pull-left">
                    {{ Html::image('/images/logo.jpg', 'alt', ['width' => 150, 'height' => 150]) }}
                </div>
            </div>
            <div class="col-xs-9">
                <h1><center>Bara Moheshkhali Girls' High School</center></h1>
            <center><h3>
                <i class="fa fa-file-text-o"></i>
                Student Information & Result Details
            </h3></center>
            </div>
        </div>
    <hr>
    <div class="row">
        <div class="col-xs-4">
            <table class="table">
                <tr>
                    <td style="border: 0;">Student Name:</td>
                    <td style="border: 0;"><strong>{{ $result->student->name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Roll No.:</td>
                    <td style="border: 0;"><strong>{{ $result->student->roll_no }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Class:</td>
                    <td  style="border: 0;"><strong>{{ $result->student->level->name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Section:</td>
                    <td style="border: 0;"><strong>{{ $result->student->section->name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Term:</td>
                    <td style="border: 0;"><strong>{{ $result->term->name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Year:</td>
                    <td style="border: 0;"><strong>{{ $result->student->year->year }}</strong></td>
                </tr>
            </table>
        </div>
        <div class="col-xs-1"></div>
        <div class="col-xs-4">
            <table class="table">
                <tr>
                    <td style="border: 0;">Father's Name:</td>
                    <td style="border: 0;"><strong>{{ $result->student->father_name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Mother's Name:</td>
                    <td style="border: 0;"><strong>{{ $result->student->mother_name }}</strong></td>
                </tr>
                <tr>
                    <td style="border: 0;">Address:</td>
                    <td style="border: 0;"><strong>{{ $result->student->address }}</strong></td>
                </tr>
            </table>
        </div>
        <div class="col-xs-3">
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
                        <th>SL</th>
                        <th>Subject Name</th>
                        <th>Total Mark</th>
                        <th>Pass Mark</th>
                        <th>Get Mark</th>
                        <th>Get Mark in %</th>
                        <th>Grade Point</th>
                        <th>Grade</th>
                        <th>GPA</th>
                        <th>Total Marks</th>
                        @if($totalFail > 0)
                            <th>Fail Subject(s)</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 0;
                ?>
                @foreach($resultDetailsBySubject as  $details)
                    @if(!count($details->resultDetails))
                        <tr class="">
                            <td class="absent">{{ ++$i }}</td>
                            <td class="absent">{{ $details->name }}</td>
                            <td class="absent">{{ $details->total_mark }}</td>
                            <td class="absent">{{ $details->pass_mark }}</td>
                            <td class="absent"><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>
                            <td class="absent">{{ $details->resultDetails->first()->get_mark_percentage or ' ' }}</td>
                            <td class="absent">{{ $details->resultDetails->first()->grade_point or ' ' }}</td>
                            <td class="absent">{{ $details->resultDetails->first()->grade or ' ' }}</td>

                            @if($i == 1)
                                <td style="vertical-align: middle; text-align: center; background-color: white; color: gray;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalResult }}</strong></td>
                                <td style="vertical-align: middle; text-align: center; background-color: white; color: gray;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalMarks }}</strong></td>
                                @if($totalFail > 0)
                                    <td style="vertical-align: middle; text-align: center; background-color: white; color: gray;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalFail }}</strong></td>
                                @endif
                            @endif
                        </tr>
                    @else
                        @if($details->resultDetails->first()->get_mark < $details->pass_mark)
                            <tr>
                                <td class="fail">{{ ++$i }}</td>
                                <td class="fail">{{ $details->name }}</td>
                                <td class="fail">{{ $details->total_mark }}</td>
                                <td class="fail">{{ $details->pass_mark }}</td>
                                <td class="fail"><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>
                                <td class="fail">{{ $details->resultDetails->first()->get_mark_percentage or ' ' }}</td>
                                <td class="fail">{{ $details->resultDetails->first()->grade_point or ' ' }}</td>
                                <td class="fail">{{ $details->resultDetails->first()->grade or ' ' }}</td>
                                @if($i==1)
                                    <td style="vertical-align: middle; text-align: center; background-color: white; color: black;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalResult }}</strong></td>
                                    <td style="vertical-align: middle; text-align: center; background-color: white; color: black;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalMarks }}</strong></td>
                                    @if($totalFail > 0)
                                        <td style="vertical-align: middle; text-align: center; background-color: white; color: black;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalFail }}</strong></td>
                                    @endif
                                @endif
                            </tr>

                        @else
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $details->name }}</td>
                                <td>{{ $details->total_mark }}</td>
                                <td>{{ $details->pass_mark }}</td>
                                <td><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>
                                <td>{{ $details->resultDetails->first()->get_mark_percentage or ' ' }}</td>
                                <td>{{ $details->resultDetails->first()->grade_point or ' ' }}</td>
                                <td>{{ $details->resultDetails->first()->grade or ' ' }}</td>
                                @if($i==1)
                                    <td style="vertical-align: middle; text-align: center; background-color: white;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalResult }}</strong></td>
                                    <td style="vertical-align: middle; text-align: center; background-color: white;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalMarks }}</strong></td>
                                    @if($totalFail > 0)
                                        <td style="vertical-align: middle; text-align: center; background-color: white;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalFail }}</strong></td>
                                    @endif
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
    <input type="button" class="no-print btn btn-primary" value="Print this page" onClick="window.print()">
@endsection