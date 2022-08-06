<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses_speaker extends Model
{
    use HasFactory;

     protected $fillable = [
        'course_ID',
        'speaker_ID'
    ];

}
