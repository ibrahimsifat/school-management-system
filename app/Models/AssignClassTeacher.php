<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AssignClassTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'course_id',
        'status',
    ];

    /**
     * Get AssignClassTeacher with created_by
     *
     */
    static public function getAllAssignClassTeachers()
    {
        $assignClassTeachers = AssignClassTeacher::select('assign_class_teachers.*', 'courses.name as course_name', 'users.name as created_by',  'users.name as teacher_name')
            ->join('users', 'users.id', '=', 'assign_class_teachers.teacher_id')
            ->join('courses', 'courses.id', '=', 'assign_class_teachers.course_id');

        // check if email and name is searched
        $requestedStatus = Request::get('status');
        $requestedCourse = Request::get('course');
        $requestedTeacher = Request::get('teacher');
        $requestedDate = Request::get('date');

        if ($requestedStatus) {
            $assignClassTeachers = $assignClassTeachers->where('assign_class_teachers.status',  $requestedStatus);
        }
        if ($requestedCourse) {
            $assignClassTeachers = $assignClassTeachers->where('courses.name', 'like', '%' . $requestedCourse . '%');
        }
        if ($requestedTeacher) {
            $assignClassTeachers = $assignClassTeachers->where('users.name', 'like', '%' . $requestedTeacher . '%');
        }
        if ($requestedDate) {
            $assignClassTeachers = $assignClassTeachers->whereDate('assign_class_teachers.created_at',  $requestedDate);
        }
        return $assignClassTeachers->orderBy('assign_class_teachers.id', 'desc')
            ->paginate(10);
    }
    static public function getActiveAssignClassTeacher()
    {
        $assignClassTeachers = AssignClassTeacher::select('assign_class_teachers.*', 'users.name as created_by')
            ->join('users', 'users.id', '=', 'assign_class_teachers.created_by')
            ->where('assign_class_teachers.status', '=', 'active')
            ->orderBy('assign_class_teachers.id', 'desc')
            ->paginate(10);
        return $assignClassTeachers;
    }

    static public function getClassesSubjects($teacher_id)
    {
        $result = AssignClassTeacher::select('assign_class_teachers.*', 'courses.name as course_name', 'subjects.name as subject_name',  'subjects.type as subject_type', 'courses.id as course_id', 'subjects.id as subject_id')
            ->join('users', 'users.id', '=', 'assign_class_teachers.created_by')
            ->join('courses', 'courses.id', '=', 'assign_class_teachers.course_id')
            ->join('assign_subjects', 'assign_subjects.course_id', '=', 'courses.id')
            ->join('subjects', 'subjects.id', '=', 'assign_subjects.subject_id')
            ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
            ->where('assign_class_teachers.status', '=', 'active')
            ->where('subjects.status', '=', 'active')
            ->where('courses.status', '=', 'active')
            ->where('assign_subjects.status', '=', 'active')
            ->orderBy('assign_class_teachers.id', 'desc')
            ->paginate(10);
        return $result;
    }
    static public function getPublishedStudentTeachers($course_id)
    {
        $assignClassTeachers = AssignClassTeacher::select('assign_class_teachers.*', 'courses.name as course_name', 'teachers.name as teacher_name')
            ->join('courses', 'courses.id', '=', 'assign_class_teachers.course_id')
            ->join('users', 'users.id', '=', 'assign_class_teachers.teacher_id')
            ->where('assign_class_teachers.status', '=', 'active')
            ->where('assign_class_teachers.course_id', '=', $course_id)
            ->orderBy('assign_class_teachers.id', 'desc');

        return $assignClassTeachers->get();
    }
    static public function getClassTeachers($classId)
    {
        $assignClassTeachers = AssignClassTeacher::select('assign_class_teachers.*', 'courses.name as course_name', 'users.name as teacher_name')
            ->join('courses', 'courses.id', '=', 'assign_class_teachers.course_id')
            ->join('users', 'users.id', '=', 'assign_class_teachers.teacher_id')
            ->where('assign_class_teachers.course_id', '=', $classId)
            ->orderBy('assign_class_teachers.id', 'desc');

        return $assignClassTeachers->get();
    }
    static public function getAssignClassTeacherById($id)
    {
        return AssignClassTeacher::find($id);
    }

    static public  function isTeacherAssigned($teacher_id, $course_id)
    {
        return AssignClassTeacher::where('course_id', $teacher_id)->where('course_id', $course_id)->first();
    }

    static public function getAssignClassTeacherId($course_id)
    {
        return AssignClassTeacher::where('course_id', $course_id)->get();
    }

    static public function deleteAssignClassTeacher($course_id)
    {
        return AssignClassTeacher::where('course_id', $course_id)->delete();
    }

    static public function getTeacherTimetable($course_id, $subject_id)
    {
        $weeksData = (object)[
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
            '7' => 'Sunday'
        ];
        $weekId = date('w');
        $result = ClassTimetable::GetRecordClassSubject($course_id, $subject_id, $weekId);
        // dd($weekId);
        if ($result) {
            $result->start_time = date('h:i A', strtotime($result->start_time));
            $result->end_time = date('h:i A', strtotime($result->end_time));
        }
        return $result;
    }
}
