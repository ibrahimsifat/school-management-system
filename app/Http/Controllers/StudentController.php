<?php

namespace App\Http\Controllers;

use App\Models\AssignSubject;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::getActiveCourses();
        $students = User::getStudents();
        return view('admin.student.index', [
            'title' => 'Students',
            'students' => $students,
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::getActiveCourses();
        return view('admin.student.create', [
            'title' => 'Create Student',
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [

                'name' => 'required|string|max:255|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'admission_number' => 'required|unique:users|max:10',
                'roll_number' => 'required|unique:users|max:10',
                'course_id' => 'required',
                'gender' => 'required|in:male,female,other',
                'last_name' => 'max:255',
                'caste' => 'max:25',
                'religion' => 'max:50',
                'mobile_number' => 'max:16',
                'blood_group' => 'max:10',
                'height' => 'max:10',
                'weight' => 'max:10',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }


            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'student';
            $user->admission_number = $request->admission_number;
            $user->roll_number = $request->roll_number;
            $user->course_id = $request->course_id;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->caste = $request->caste;
            $user->religion = $request->religion;
            $user->mobile_number = $request->mobile_number;
            $user->admission_date = $request->admission_date;
            if (!empty($request->image)) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('public/uploads/'), $filename);
                $user->image = $filename;
            }
            $user->blood_group = $request->blood_group;
            $user->height = $request->height;
            $user->weight = $request->weight;
            $user->save();
            return redirect()->back()->with('success', 'Student created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::getIdSingle($id);
        $courses = Course::getActiveCourses();
        $image = '';
        if ($user->image) {
            $image = asset('public/uploads/' . $user->image);
        }
        return view('admin.student.edit', [
            'title' => 'Edit Student',
            'user' => $user,
            'courses' => $courses,
            'image' => $image
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $user = User::getIdSingle($id);
            if (!$user) {
                return redirect()->back()->with('error', 'Student not found');
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|email|unique:users,email,' . $id,
                'admission_number' =>
                'required|unique:users,admission_number,' . $id . '|max:10',
                'roll_number' => 'required|unique:users,roll_number,' . $id . '|max:10',
                'course_id' => 'required',
                'gender' => 'required|in:male,female,other',
                'last_name' => 'max:255',
                'caste' => 'max:25',
                'religion' => 'max:50',
                'mobile_number' => 'max:20',
                'blood_group' => 'max:10',
                'height' => 'max:10',
                'weight' => 'max:10',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->admission_number = $request->admission_number;
            $user->roll_number = $request->roll_number;
            $user->course_id = $request->course_id;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->caste = $request->caste;
            $user->religion = $request->religion;
            $user->mobile_number = $request->mobile_number;
            $user->admission_date = $request->admission_date;
            if (!empty($request->image)) {
                // delete previous image
                if ($user->image) {
                    unlink(public_path('public/uploads/' . $user->image));
                }
                // upload new image
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('public/uploads/'), $filename);
                $user->image = $filename;
            }
            $user->blood_group = $request->blood_group;
            $user->height = $request->height;
            $user->weight = $request->weight;
            $user->save();
            return redirect()->back()->with('success', 'Student Updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the student resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::getIdSingle($id);
            if (!$user) {
                return redirect()->back()->with('error', 'Student not found');
            }
            if ($user->image && file_exists(public_path('public/uploads/' . $user->image))) {
                unlink(public_path('public/uploads/' . $user->image));
            }
            $user->delete();
            return redirect()->back()->with('success', 'Student deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }



    /**
     * Display the guardianStudents  resource.
     */

    public function guardianStudents(Request $request)
    {
        $user = Auth::user();
        if (!$user->role == 'guardian') {
            return redirect()->back()->with('error', 'You are not authorized to access this page');
        }

        $students = User::getGuardianStudents($user->id);
        return view('guardian.guardianStudents', [
            'title' => 'Guardian Students',
            'students' => $students
        ]);
    }

    /**
     * Display the guardianStudent Subjects  resource.
     */
    public function guardianStudentSubjects(Request $request, $studentId)
    {
        $student = User::getActiveStudent($studentId);
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }
        $subjects = AssignSubject::getPublishedStudentSubjects($student->course_id);

        return view('guardian.guardianStudentSubjects', [
            'title' => 'Guardian Student Subjects',
            'subjects' => $subjects
        ]);
    }
}
