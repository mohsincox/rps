<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultDetail extends Model
{
    protected $table = 'result_details';

    protected $fillable = [
        'result_id',
        'subject_id',
        'get_mark',
        'get_mark_percentage',
        'grade',
        'grade_point',
        'total_point'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
