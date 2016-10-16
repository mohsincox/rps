<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultDetail extends Model
{
    protected $table = 'result_details';

    protected $fillable = [
        'result_id',
        'subject_id',
        'get_mark'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
