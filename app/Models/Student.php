<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'name',
        'roll',
        'class_id',
        'section_id',
        'year_id',
        'father_name',
        'mother_name',
        'address',
        'image'
    ];

    public function classes()
    {
        $this->belongsTo(Classes::class);
    }

    public function section()
    {
        $this->belongsTo(Section::class);
    }

    public function year()
    {
        $this->belongsTo(Year::class);
    }
}