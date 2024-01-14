<?php

namespace App\Http\Controllers;

use App\Models\AssignSubject;
use App\Http\Requests\StoreAssignSubjectRequest;
use App\Http\Requests\UpdateAssignSubjectRequest;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignSubjects = AssignSubject::getAllAssignSubjects();
        return view('admin.assignSubject.index', [
            'title' => 'AssignSubjects',
            'assignSubjects' => $assignSubjects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::getActiveSubjects();
        $courses = Course::getActiveCourses();

        return view('admin.assignSubject.create', [
            'title' => 'Create AssignSubject',
            'subjects' => $subjects,
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignSubjectRequest $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'status' => 'required',
                'course_id' => 'required',
                'subject_id' => 'required|array|min:1'
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }

            $course = Course::getCourseById($request->course_id);
            if (!$course)
                return redirect()->back()->with('error', 'Course Not Found');


            foreach ($request->subject_id as $subject_id) {
                $subject = Subject::getSubjectById($subject_id);
                if (!$subject)
                    return redirect()->back()->with('error', 'Subject Not Found');

                $isAssignSubject = AssignSubject::isSubjectAssigned($subject_id, $request->course_id);

                if ($isAssignSubject) {
                    $isAssignSubject->status = $request->status;
                    $isAssignSubject->save();
                } else {

                    $assignSubject = new AssignSubject();
                    $assignSubject->name = $request->name;
                    $assignSubject->status = $request->status;
                    $assignSubject->course_id = $request->course_id;
                    $assignSubject->subject_id = $subject_id;
                    $assignSubject->created_by = Auth::user()->id;
                    $assignSubject->save();
                }
            }
            return redirect()->route('assignSubject.index')->with('success', 'AssignSubject Created Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignSubject $assignSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, AssignSubject $assignSubject)
    {
        $assignSubject = AssignSubject::getAssignSubjectById($id);
        if (!$assignSubject)
            return redirect()->route('assignSubject.index')->with('error', 'AssignSubject Not Found');

        $getAssignSubjectId = AssignSubject::getAssignSubjectId($assignSubject->course_id);
        $subjects = Subject::getActiveSubjects();
        $courses = Course::getActiveCourses();

        if (!$assignSubject)
            return redirect()->route('assignSubject.index')->with('error', 'AssignSubject Not Found');
        return view('admin.assignSubject.edit', [
            'title' => 'Edit AssignSubject',
            'assignSubject' => $assignSubject,
            'subjects' => $subjects,
            'courses' => $courses,
            'getAssignSubjectId' => $getAssignSubjectId

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignSubjectRequest $request, AssignSubject $assignSubject)
    {
        // dd($request->all());
        AssignSubject::deleteAssignSubject($request->course_id);

        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'status' => 'required',
                'course_id' => 'required',
                'subject_id' => 'required|array|min:1'
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }

            $course = Course::getCourseById($request->course_id);
            if (!$course)
                return redirect()->back()->with('error', 'Course Not Found');

            foreach ($request->subject_id as $subject_id) {
                $subject = Subject::getSubjectById($subject_id);
                if (!$subject)
                    return redirect()->back()->with('error', 'Subject Not Found');

                $isAssignSubject = AssignSubject::isSubjectAssigned($subject_id, $request->course_id);
                if ($isAssignSubject) {
                    $isAssignSubject->status = $request->status;
                    $isAssignSubject->save();
                } else {

                    $assignSubject = new AssignSubject();
                    $assignSubject->name = $request->name;
                    $assignSubject->status = $request->status;
                    $assignSubject->course_id = $request->course_id;
                    $assignSubject->subject_id = $subject_id;
                    $assignSubject->created_by = Auth::user()->id;
                    $assignSubject->save();
                }
            }
            return redirect()->route('assignSubject.index')->with('success', 'AssignSubject Updated Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit_single($id, AssignSubject $assignSubject)
    {
        $assignSubject = AssignSubject::getAssignSubjectById($id);
        if (!$assignSubject)
            return redirect()->route('assignSubject.index')->with('error', 'AssignSubject Not Found');

        $subjects = Subject::getActiveSubjects();
        $courses = Course::getActiveCourses();

        if (!$assignSubject)
            return redirect()->route('assignSubject.index')->with('error', 'AssignSubject Not Found');
        return view('admin.assignSubject.edit_single', [
            'title' => 'Edit AssignSubject',
            'assignSubject' => $assignSubject,
            'subjects' => $subjects,
            'courses' => $courses,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update_single(UpdateAssignSubjectRequest $request, AssignSubject $assignSubject)
    {
        $subject = AssignSubject::getAssignSubjectById($request->id);
        if (!$subject)
            return redirect()->back()->with('error', 'Assign Subject Not Found');

        $isAssignSubject = AssignSubject::isSubjectAssigned($request->subject_id, $request->course_id);
        if ($isAssignSubject) {
            $isAssignSubject->status = $request->status;
            $isAssignSubject->save();
            return redirect()->route('assignSubject.index')->with('success', 'Status Updated Successfully');
        } else {

            $subject->name = $request->name;
            $subject->status = $request->status;
            $subject->course_id = $request->course_id;
            $subject->subject_id = $request->subject_id;
            $subject->updated_by = Auth::user()->id;
            $subject->save();
            return redirect()->route('assignSubject.index')->with('success', 'AssignSubject Updated Successfully');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, AssignSubject $assignSubject)
    {
        $assignSubject = AssignSubject::getAssignSubjectById($id);

        if (!$assignSubject)
            return redirect()->route('assignSubject.index')->with('error', 'AssignSubject Not Found');
        try {
            $assignSubject->delete();
            return redirect()->route('assignSubject.index')->with('success', 'AssignSubject Deleted Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
