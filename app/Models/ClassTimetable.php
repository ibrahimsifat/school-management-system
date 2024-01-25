<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTimetable extends Model
{
    use HasFactory;
    protected $table = 'class_timetables';

    static public function GetRecordClassSubject($courseId, $subjectId, $weekId)
    {
        return ClassTimetable::where('course_id', $courseId)->where('subject_id', $subjectId)->where('week_id', $weekId)->first();
    }
}
