<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'total_mark',
        'total_mark_in_percentage',
        'pass_mark',
        'pass_mark_in_percentage'
    ];

    public function resultDetails()
    {
        return $this->hasMany(ResultDetail::class);
    }
}
