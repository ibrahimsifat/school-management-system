<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;
    // protected $table = 'exam_schedules';
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

    static public function getExamScheduleByCourse($course_id)
    {
        return ExamSchedule::select('exam_schedules.*', 'exam.name as examination_name')
            ->join('examinations as exam', 'exam.id', '=', 'exam_schedules.examination_id')
            ->where('exam_schedules.course_id', $course_id)
            ->orderBy('exam_schedules.id', 'desc')
            ->get();
    }

    static public function getExamTimeTable($course_id, $examination_id)
    {
        return ExamSchedule::select('exam_schedules.*', 'subjects.name as subject_name', 'subjects.type as subject_type')
            ->join('subjects', 'subjects.id', '=', 'exam_schedules.subject_id')
            ->where('exam_schedules.course_id', $course_id)
            ->where('exam_schedules.examination_id', $examination_id)
            ->get();
    }
}
