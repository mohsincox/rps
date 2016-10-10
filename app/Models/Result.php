<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    protected $fillable = [
        'student_id',
        'term_id',
        'year_id'
    ];
}
