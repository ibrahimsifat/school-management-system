<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $fillable = [
        'name',
        'description',
        'slug',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Get Course with created_by
     *
     */
    static public function getAllCourses()
    {
        $courses = Course::select('courses.*', 'users.name as created_by')
            ->join('users', 'users.id', '=', 'courses.created_by');

        // check if email and name is searched
        $requestedStatus = Request::get('status');
        $requestedName = Request::get('name');
        $requestedDate = Request::get('date');

        if ($requestedStatus) {
            $courses = $courses->where('courses.status',  $requestedStatus);
        }
        if ($requestedName) {
            $courses = $courses->where('courses.name', 'like', '%' . $requestedName . '%');
        }
        if ($requestedDate) {
            $courses = $courses->whereDate('courses.created_at',  $requestedDate);
        }
        return $courses->orderBy('courses.id', 'desc')
            ->paginate(10);
    }
    static public function getActiveCourses()
    {
        return Course::where('status', 'active')->get();
    }

    static public function getCourseById($id)
    {
        return Course::find($id);
    }
}
