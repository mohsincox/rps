@extends('layouts.app')

@section('content')
    <h1>
        <i class="fa fa-file-text-o"></i>
        Result Details
    </h1>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <td>Student Name:</td>
                    <th>{{ $result->student->name }}</th>
                </tr>
                <tr>
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
                    $totalPoint = 0;
                    $print = true;

                        foreach($resultDetails as $p) {
                            $getPercentage = (100 * $p->get_mark) / $p->subject->total_mark;
                            $getPercentage = round($getPercentage);
                            if(($getPercentage >= 80) && ($getPercentage <= 100)) {
                                $grade = 'A+';
                                $gradePoint = 5;
                            }
                            else if(($getPercentage >= 70) && ($getPercentage <= 79)) {
                                $grade = 'A';
                                $gradePoint = 4;
                            }
                            else if(($getPercentage >= 60) && ($getPercentage <= 69)) {
                                $grade = 'A-';
                                $gradePoint = 3.5;
                            }
                            else if(($getPercentage >= 50) && ($getPercentage <= 59)) {
                                $grade = 'B';
                                $gradePoint = 3;
                            }
                            else if(($getPercentage >= 40) && ($getPercentage <= 49)) {
                                $grade = 'C';
                                $gradePoint = 2;
                            }
                            else if(($getPercentage >= 33) && ($getPercentage <= 39)) {
                                $grade = 'D';
                                $gradePoint = 1;
                            }
                            else {
                                $grade = 'F';
                                $gradePoint = 0;
                            }
                            $totalPoint = $totalPoint + $gradePoint;
                        }

                ?>
                @foreach($resultDetails as $details)
                    <tr>
                        {{--<td>{{ $details->id }}</td>--}}
                        <td>{{ ++$i }}</td>
                        <td>{{ $details->subject->name }}</td>
                        <td>{{ $details->subject->total_mark }}</td>
                        <td>{{ $details->subject->pass_mark }}</td>
                        <td>{{ $details->get_mark }}</td>
                        <?php
                            $getMarkPercentage = (100 * $details->get_mark) / $details->subject->total_mark;
                        $getMarkPercentage = round($getMarkPercentage);
                            if(($getMarkPercentage >= 80) && ($getMarkPercentage <= 100)) {
                                $grade = 'A+';
                                $gradePoint = 5;
                            }
                            else if(($getMarkPercentage >= 70) && ($getMarkPercentage <= 79)) {
                                $grade = 'A';
                                $gradePoint = 4;
                            }
                            else if(($getMarkPercentage >= 60) && ($getMarkPercentage <= 69)) {
                                $grade = 'A-';
                                $gradePoint = 3.5;
                            }
                            else if(($getMarkPercentage >= 50) && ($getMarkPercentage <= 59)) {
                                $grade = 'B';
                                $gradePoint = 3;
                            }
                            else if(($getMarkPercentage >= 40) && ($getMarkPercentage <= 49)) {
                                $grade = 'C';
                                $gradePoint = 2;
                            }
                            else if(($getMarkPercentage >= 33) && ($getMarkPercentage <= 39)) {
                                $grade = 'D';
                                $gradePoint = 1;
                            }
                            else {
                                $grade = 'F';
                                $gradePoint = 0;
                            }
                           //$totalPoint = $totalPoint + $gradePoint;
                        ?>
                        <td>{{ $getMarkPercentage }}</td>
                        <td>{{ $gradePoint }}</td>
                        <td>{{ $grade }}</td>
                        @if($print)
                            <td rowspan="11"  style="text-align: center;">{{ round($totalPoint/11, 2, PHP_ROUND_HALF_UP) }}</td>
                            @php
                                $print = false;
                            @endphp
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection