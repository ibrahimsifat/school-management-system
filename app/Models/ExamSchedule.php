<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;

    static public function getAllActiveExaminations()
    {
        return ExamSchedule::where('status', 'active')->get();
    }

    static public function getExamSchedule($course_id, $examination_id, $subject_id)
    {
        return ExamSchedule::where('course_id', $course_id)->where('examination_id', $examination_id)->where('subject_id', $subject_id)->first();
    }

    static public function deleteExisting($examination_id, $course_id)
    {
        return ExamSchedule::where('examination_id', $examination_id)->where('course_id', $course_id)->delete();
    }
}
