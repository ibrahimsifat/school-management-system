<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Http\Requests\StoreAssignClassTeacherRequest;
use App\Http\Requests\UpdateAssignClassTeacherRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssignClassTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignClassTeachers = AssignClassTeacher::getAllAssignClassTeachers();
        return view('admin.assignClassTeacher.index', [
            'title' => 'AssignClassTeachers',
            'assignTeachers' => $assignClassTeachers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::getActiveTeachers();
        $courses = Course::getActiveCourses();

        return view('admin.assignClassTeacher.create', [
            'title' => 'Create AssignClassTeacher',
            'teachers' => $teachers,
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignClassTeacherRequest $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'status' => 'required',
                'course_id' => 'required',
                'teacher_id' => 'required|array|min:1'
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }

            $course = Course::getCourseById($request->course_id);
            if (!$course)
                return redirect()->back()->with('error', 'Course Not Found');


            foreach ($request->teacher_id as $teacher_id) {
                $teacher = User::getActiveTeachers();
                if (!$teacher)
                    return redirect()->back()->with('error', 'Teacher Not Found');

                $isAssignClassTeacher = AssignClassTeacher::isTeacherAssigned($teacher_id, $request->course_id);

                if ($isAssignClassTeacher) {
                    $isAssignClassTeacher->status = $request->status;
                    $isAssignClassTeacher->save();
                } else {

                    $assignClassTeacher = new AssignClassTeacher();
                    $assignClassTeacher->status = $request->status;
                    $assignClassTeacher->course_id = $request->course_id;
                    $assignClassTeacher->teacher_id = $teacher_id;
                    $assignClassTeacher->created_by = Auth::user()->id;
                    $assignClassTeacher->save();
                }
            }
            return redirect()->route('assignClassTeacher.index')->with('success', 'AssignClassTeacher Created Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignClassTeacher $assignClassTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, AssignClassTeacher $assignClassTeacher)
    {
        $assignClassTeacher = AssignClassTeacher::getAssignClassTeacherById($id);
        if (!$assignClassTeacher)
            return redirect()->route('assignClassTeacher.index')->with('error', 'AssignClassTeacher Not Found');

        $getAssignClassTeacherId = AssignClassTeacher::getAssignClassTeacherId($assignClassTeacher->course_id);
        $teachers = User::getActiveTeachers();
        $courses = Course::getActiveCourses();

        if (!$assignClassTeacher)
            return redirect()->route('assignClassTeacher.index')->with('error', 'AssignClassTeacher Not Found');
        return view('admin.assignClassTeacher.edit', [
            'title' => 'Edit AssignClassTeacher',
            'assignClassTeacher' => $assignClassTeacher,
            'teachers' => $teachers,
            'courses' => $courses,
            'getAssignClassTeacherId' => $getAssignClassTeacherId

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignClassTeacherRequest $request, AssignClassTeacher $assignClassTeacher)
    {

        AssignClassTeacher::deleteAssignClassTeacher($request->course_id);

        try {
            $validate = Validator::make($request->all(), [
                'status' => 'required',
                'course_id' => 'required',
                'teacher_id' => 'required|array|min:1'
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }

            $course = Course::getCourseById($request->course_id);
            if (!$course)
                return redirect()->back()->with('error', 'Course Not Found');

            foreach ($request->teacher_id as $teacher_id) {
                $teacher = User::getTeacherById($teacher_id);
                if (!$teacher)
                    return redirect()->back()->with('error', 'Teacher Not Found');

                $isAssignClassTeacher = AssignClassTeacher::isTeacherAssigned($teacher_id, $request->course_id);
                if ($isAssignClassTeacher) {
                    $isAssignClassTeacher->status = $request->status;
                    $isAssignClassTeacher->save();
                } else {

                    $assignClassTeacher = new AssignClassTeacher();
                    $assignClassTeacher->status = $request->status;
                    $assignClassTeacher->course_id = $request->course_id;
                    $assignClassTeacher->teacher_id = $teacher_id;
                    $assignClassTeacher->created_by = Auth::user()->id;
                    $assignClassTeacher->save();
                }
            }
            return redirect()->route('assignClassTeacher.index')->with('success', 'AssignClassTeacher Updated Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit_single($id, AssignClassTeacher $assignClassTeacher)
    {
        $assignClassTeacher = AssignClassTeacher::getAssignClassTeacherById($id);
        if (!$assignClassTeacher)
            return redirect()->route('assignClassTeacher.index')->with('error', 'AssignClassTeacher Not Found');

        $teachers = User::getActiveTeachers();
        $courses = Course::getActiveCourses();

        if (!$assignClassTeacher)
            return redirect()->route('assignClassTeacher.index')->with('error', 'AssignClassTeacher Not Found');
        return view('admin.assignClassTeacher.edit_single', [
            'title' => 'Edit AssignClassTeacher',
            'assignClassTeacher' => $assignClassTeacher,
            'teachers' => $teachers,
            'courses' => $courses,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update_single(UpdateAssignClassTeacherRequest $request, AssignClassTeacher $assignClassTeacher)
    {
        $teacher = AssignClassTeacher::getAssignClassTeacherById($request->id);
        if (!$teacher)
            return redirect()->back()->with('error', 'Assign Teacher Not Found');

        $isAssignClassTeacher = AssignClassTeacher::isTeacherAssigned($request->teacher_id, $request->course_id);
        if ($isAssignClassTeacher) {
            $isAssignClassTeacher->status = $request->status;
            $isAssignClassTeacher->save();
            return redirect()->route('assignClassTeacher.index')->with('success', 'Status Updated Successfully');
        } else {

            $teacher->status = $request->status;
            $teacher->course_id = $request->course_id;
            $teacher->teacher_id = $request->teacher_id;
            $teacher->updated_by = Auth::user()->id;
            $teacher->save();
            return redirect()->route('assignClassTeacher.index')->with('success', 'AssignClassTeacher Updated Successfully');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, AssignClassTeacher $assignClassTeacher)
    {
        $assignClassTeacher = AssignClassTeacher::getAssignClassTeacherById($id);

        if (!$assignClassTeacher)
            return redirect()->route('assignClassTeacher.index')->with('error', 'AssignClassTeacher Not Found');
        try {
            $assignClassTeacher->delete();
            return redirect()->route('assignClassTeacher.index')->with('success', 'AssignClassTeacher Deleted Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Get Teacher Subjects
     */
    public function teacherSubjects(AssignClassTeacher $assignClassTeacher)
    {
        $id = Auth::user()->id;
        if (Auth::user()->role != 'teacher') {
            return redirect()->back()->with('error', 'You are not authorized to access this page');
        }
        $getClassesSubjects = AssignClassTeacher::getClassesSubjects($id);
        return view('teacher.subjects', [
            'title' => 'Teacher Subjects',
            'getClassesSubjects' => $getClassesSubjects
        ]);
    }
}
