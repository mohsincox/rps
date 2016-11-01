<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    protected $fillable = [
        'student_id',
        'level_id',
        'term_id',
        'year_id',
        'total_point',
        'result'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
