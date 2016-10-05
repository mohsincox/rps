<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'name',
        'roll_no',
        'level_id',
        'section_id',
        'year_id',
        'father_name',
        'mother_name',
        'address',
        'image'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}