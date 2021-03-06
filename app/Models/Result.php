<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    protected $fillable = [
        'student_id',
        'level_id',
        'section_id',
        'year_id',
        'term_id',
        'total_point',
        'grade_point_avg',
        'result',
        'total_get_mark',
        'fail_subject'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

//    public function year()
//    {
//        return $this->belongsTo(Year::class);
//    }

//    public function level()
//    {
//        return $this->belongsTo(Level::class);
//    }

}
