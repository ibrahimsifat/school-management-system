<?php

namespace App\Http\Controllers;

use App\Models\ExamSchedule;
use App\Http\Requests\StoreExamScheduleRequest;
use App\Http\Requests\UpdateExamScheduleRequest;
use App\Models\AssignSubject;
use App\Models\Course;
use App\Models\Examination;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ExamScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::getActiveCourses();
        $examinations = Examination::getExaminations();
        $results = [];


        if (!empty($request->course_id) && !empty($request->examination_id)) {
            $subjects = AssignSubject::getClassSubjects($request->get('course_id'));
            // dd($subjects);
            foreach ($subjects as $subject) {
                $data = array();
                $data['subject_id'] = $subject->subject_id;
                $data['course_id'] = $subject->course_id;
                $data['subject_name'] = $subject->subject_name;
                $data['subject_type'] = $subject->subject_type;

                $examSchedule = ExamSchedule::getExamSchedule($request->get('course_id'), $request->get('examination_id'), $subject->subject_id);
                if ($examSchedule) {
                    $data['exam_date'] = $examSchedule->exam_date;
                    $data['start_time'] = $examSchedule->start_time;
                    $data['end_time'] = $examSchedule->end_time;
                    $data['full_marks'] = $examSchedule->full_marks;
                    $data['pass_marks'] = $examSchedule->pass_marks;
                    $data['room_number'] = $examSchedule->room_number;
                } else {
                    $data['exam_date'] = '';
                    $data['start_time'] = '';
                    $data['end_time'] = '';
                    $data['full_marks'] = '';
                    $data['pass_marks'] = '';
                    $data['room_number'] = '';
                }
                $results[] = $data;
            }
        }

        return view('admin.examSchedule.index', [
            'title' => 'Examination',
            'courses' => $courses,
            'examinations' => $examinations,
            'results' => $results

        ]);
    }

    /**
     * Show the form for creating a new resource.   
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamScheduleRequest $request)
    {

        $validator = FacadesValidator::make($request->all(), [
            'course_id' => 'required',
            'examination_id' => 'required',
            'schedule' => 'required',
            'schedule.*.full_marks' => 'numeric',
            'schedule.*.pass_marks' => 'numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $schedule = $request->schedule;
        // delete existing schedule
        ExamSchedule::deleteExisting($request->examination_id, $request->course_id);
        if ($schedule) {
            foreach ($schedule as $value) {
                // dd($value);
                if (!empty($value['subject_id']) && !empty($value['exam_date']) && !empty($value['start_time']) && !empty($value['end_time']) && !empty($value['full_marks']) && !empty($value['pass_marks']) && !empty($value['room_number'])) {
                    $exam = new ExamSchedule();
                    $exam->course_id = $request->course_id;
                    $exam->examination_id = $request->examination_id;
                    $exam->subject_id = $value['subject_id'];
                    $exam->exam_date = $value['exam_date'];
                    $exam->start_time = $value['start_time'];
                    $exam->end_time = $value['end_time'];
                    $exam->full_marks = $value['full_marks'];
                    $exam->pass_marks = $value['pass_marks'];
                    $exam->room_number = $value['room_number'];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Exam Schedule Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamSchedule $examSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamSchedule $examSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamScheduleRequest $request, ExamSchedule $examSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamSchedule $examSchedule)
    {
        //
    }


    // ExamsTimetables

    public function examsTimetables()
    {
        $course_id = Auth::user()->course_id;
        $examSchedules = ExamSchedule::getExamScheduleByCourse($course_id);
        $results = [];
        foreach ($examSchedules as $examSchedule) {
            $dataW = array();
            $dataW['name'] = $examSchedule->examination_name;
            $getExamTimeTable = ExamSchedule::getExamTimeTable($course_id, $examSchedule->examination_id);
            $resultS = [];

            foreach ($getExamTimeTable as $examTimetable) {
                $dataS = array();
                $dataS['subject_name'] = $examTimetable->subject_name;
                $dataS['subject_type'] = $examTimetable->subject_type;
                $dataS['exam_date'] = $examTimetable->exam_date;
                $dataS['start_time'] = $examTimetable->start_time;
                $dataS['end_time'] = $examTimetable->end_time;
                $dataS['pass_marks'] = $examTimetable->pass_marks;
                $dataS['full_marks'] = $examTimetable->full_marks;
                $dataS['room_number'] = $examTimetable->room_number;
                $resultS[] = $dataS;
            }
            $dataW['exams'] = $resultS;
            $results[] = $dataW;
        }

        return view('student.examsTimetables', [
            'title' => 'Exams Timetables',
            'examTimetables' => $results
        ]);
    }
}
