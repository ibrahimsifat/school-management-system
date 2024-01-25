<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AssignSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_id',
        'course_id',
        'status',
    ];

    /**
     * Get AssignSubject with created_by
     *
     */
    static public function getAllAssignSubjects()
    {
        $assignSubjects = AssignSubject::select('assign_subjects.*', 'courses.name as course_name', 'subjects.name as subject_name', 'users.name as created_by')
            ->join('subjects', 'subjects.id', '=', 'assign_subjects.subject_id')
            ->join('courses', 'courses.id', '=', 'assign_subjects.course_id')
            ->join('users', 'users.id', '=', 'assign_subjects.created_by');

        // check if email and name is searched
        $requestedStatus = Request::get('status');
        $requestedCourse = Request::get('course');
        $requestedSubject = Request::get('subject');
        $requestedDate = Request::get('date');

        if ($requestedStatus) {
            $assignSubjects = $assignSubjects->where('assign_subjects.status',  $requestedStatus);
        }
        if ($requestedCourse) {
            $assignSubjects = $assignSubjects->where('courses.name', 'like', '%' . $requestedCourse . '%');
        }
        if ($requestedSubject) {
            $assignSubjects = $assignSubjects->where('subjects.name', 'like', '%' . $requestedSubject . '%');
        }
        if ($requestedDate) {
            $assignSubjects = $assignSubjects->whereDate('assign_subjects.created_at',  $requestedDate);
        }
        return $assignSubjects->orderBy('assign_subjects.id', 'desc')
            ->paginate(10);
    }
    static public function getActiveAssignSubject()
    {
        $assignSubjects = AssignSubject::select('assign_subjects.*', 'users.name as created_by')
            ->join('users', 'users.id', '=', 'assign_subjects.created_by')
            ->where('assign_subjects.status', '=', 'active')
            ->orderBy('assign_subjects.id', 'desc')
            ->paginate(10);
        return $assignSubjects;
    }
    static public function getPublishedStudentSubjects($course_id)
    {
        $assignSubjects = AssignSubject::select('assign_subjects.*', 'courses.name as course_name', 'subjects.name as subject_name', 'subjects.type as subject_type', 'courses.id as course_id', 'subjects.id as subject_id')
            ->join('courses', 'courses.id', '=', 'assign_subjects.course_id')
            ->join('subjects', 'subjects.id', '=', 'assign_subjects.subject_id')
            ->where('assign_subjects.status', '=', 'active')
            ->where('assign_subjects.course_id', '=', $course_id)
            ->orderBy('assign_subjects.id', 'desc');

        return $assignSubjects->get();
    }
    static public function getClassSubjects($classId)
    {
        $assignSubjects = AssignSubject::select('assign_subjects.*', 'courses.name as course_name', 'subjects.name as subject_name')
            ->join('courses', 'courses.id', '=', 'assign_subjects.course_id')
            ->join('subjects', 'subjects.id', '=', 'assign_subjects.subject_id')
            ->where('assign_subjects.course_id', '=', $classId)
            ->orderBy('assign_subjects.id', 'desc');

        return $assignSubjects->get();
    }
    static public function getAssignSubjectById($id)
    {
        return AssignSubject::find($id);
    }

    static public  function isSubjectAssigned($subject_id, $course_id)
    {
        return AssignSubject::where('course_id', $subject_id)->where('course_id', $course_id)->first();
    }

    static public function getAssignSubjectId($course_id)
    {
        return AssignSubject::where('course_id', $course_id)->get();
    }

    static public function deleteAssignSubject($course_id)
    {
        return AssignSubject::where('course_id', $course_id)->delete();
    }
}
