<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::getAllCourses();
        return view('admin.course.index', [
            'title' => 'Courses',
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.create', [
            'title' => 'Create Course',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'status' => 'required'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }
            $course = new Course();
            $course->name = $request->name;
            $course->description = $request->description;
            $course->status = $request->status;
            $course->slug = str_replace(' ', '-', strtolower($request->name));
            $course->created_by = Auth::user()->id;
            $course->save();
            return redirect()->route('course.index')->with('success', 'Course Created Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Course $course)
    {

        $course = Course::getCourseById($id);
        if (!$course)
            return redirect()->route('course.index')->with('error', 'Course Not Found');
        return view('admin.course.edit', [
            'title' => 'Edit Course',
            'course' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, UpdateCourseRequest $request, Course $course)
    {
        $course = Course::getCourseById($id);

        if (!$course)
            return redirect()->route('course.index')->with('error', 'Course Not Found');

        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'status' => 'required'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }
            $course->name = $request->name;
            $course->description = $request->description;
            $course->status = $request->status;
            $course->slug = str_replace(' ', '-', strtolower($request->name));
            $course->save();
            return redirect()->route('course.index')->with('success', 'Course Updated Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Course $course)
    {
        $course = Course::getCourseById($id);

        if (!$course)
            return redirect()->route('course.index')->with('error', 'Course Not Found');
        try {
            $course->delete();
            return redirect()->route('course.index')->with('success', 'Course Deleted Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
