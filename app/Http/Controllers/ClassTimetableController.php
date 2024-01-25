<?php

namespace App\Http\Controllers;

use App\Models\ClassTimetable;
use App\Http\Requests\StoreClassTimetableRequest;
use App\Http\Requests\UpdateClassTimetableRequest;
use App\Models\AssignSubject;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $course_id = $request->course_id;
        $subjects = [];
        if ($course_id) {
            $subjects = AssignSubject::getClassSubjects($course_id);
        }
        // $weeksData=['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        // define manually a object with weeks name and id
        $weeksData = (object)[
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
            '7' => 'Sunday'
        ];

        $weeks = [];

        foreach ($weeksData as $weekId => $weekName) {
            $dataW = [
                'week_id' => $weekId,
                'week_name' => $weekName
            ];

            if (!empty($request->course_id) && !empty($request->subject_id)) {
                $classSubject = ClassTimetable::GetRecordClassSubject($request->course_id, $request->subject_id, $weekId);
                if (empty($classSubject)) {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                } else {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                }
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }
            $weeks[] = $dataW;
        }


        $activeCourses = Course::getActiveCourses();
        return view('admin.classTimetable.index', [
            'title' => 'Class Timetable',
            'courses' => $activeCourses,
            'subjects' => $subjects,
            'weeks' => $weeks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getSubject(Request $request)
    {
        $id = $request->class_id;
        $html = '   <option selected disabled value="">Select Subject</option>';
        $subjects = AssignSubject::getClassSubjects($id);
        foreach ($subjects as $subject) {
            $html .= '<option value="' . $subject->id . '">' . $subject->subject_name . '</option>';
        }

        // return response()->json(['html' => $html]);
        $json['html'] = $html;
        echo json_encode($json);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(ClassTimetable $classTimetable)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassTimetableRequest $request)
    {
        ClassTimetable::where('course_id', $request->course_id)->where('subject_id', $request->subject_id)->delete();


        foreach ($request->timetable as $timetable) {
            if (!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number'])) {

                $classTimetable = new ClassTimetable();
                $classTimetable->course_id = $request->course_id;
                $classTimetable->subject_id = $request->subject_id;
                $classTimetable->week_id = $timetable['week_id'];
                $classTimetable->start_time = $timetable['start_time'];
                $classTimetable->end_time = $timetable['end_time'];
                $classTimetable->room_number = $timetable['room_number'];

                $classTimetable->created_by = auth()->user()->id;
                $classTimetable->save();
            }
        }
        return redirect()->back()->with('success', 'Class Timetable Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassTimetable $classTimetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassTimetable $classTimetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassTimetableRequest $request, ClassTimetable $classTimetable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassTimetable $classTimetable)
    {
        //
    }

    /// students timetable section

    public function classTimetables(Request $request)
    {
        $course = Auth::user();
        $results = [];

        $subjects = [];
        if ($course) {
            $subjects = AssignSubject::getClassSubjects($course->id);
        }
        // dd($subjects);
        // $weeksData=['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        // define manually a object with weeks name and id
        $weeksData = (object)[
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
            '7' => 'Sunday'
        ];


        foreach ($subjects as $subject) {
            $weeks = [];

            $dataS['name'] = $subject->subject_name;;

            foreach ($weeksData as $weekId => $weekName) {
                $dataW = [
                    'week_id' => $weekId,
                    'week_name' => $weekName
                ];


                $classSubject = ClassTimetable::GetRecordClassSubject($course->id, $subject->subject_id, $weekId);
                if (empty($classSubject)) {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                } else {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                }

                $weeks[] = $dataW;
            }
            $dataS['weeks'] = $weeks;
            $results[] = $dataS;
        }

        return view('student.classTimetable', [
            'title' => 'Class Timetable',
            'classTimetables' => $results
        ]);
    }

    // teacher timetable section
    public function teacherTimetables(Request $request, $course_id, $subject_id)
    {
        $course = Course::getCourseById($course_id);
        $subject = Subject::getSubjectById($subject_id);


        $weeksData = (object)[
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
            '7' => 'Sunday'
        ];


        foreach ($weeksData as $weekId => $weekName) {
            $dataW = [
                'week_id' => $weekId,
                'week_name' => $weekName
            ];


            $classSubject = ClassTimetable::GetRecordClassSubject($course_id, $subject_id, $weekId);
            if (empty($classSubject)) {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            } else {
                $dataW['start_time'] = $classSubject->start_time;
                $dataW['end_time'] = $classSubject->end_time;
                $dataW['room_number'] = $classSubject->room_number;
            }

            $results[] = $dataW;
        }


        return view('teacher.classTimetable', [
            'title' => 'Teacher Class Timetable',
            'classTimetables' => $results,
            'course' => $course,
            'subject' => $subject
        ]);
    }
}
