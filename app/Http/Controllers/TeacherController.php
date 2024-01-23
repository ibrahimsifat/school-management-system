<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::getTeachers();
        return view('admin.teacher.index', [
            'title' => 'Teachers',
            'teachers' => $teachers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::getStudents();
        return view('admin.teacher.create', [
            'title' => 'Create Teacher',
            'students' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'string|max:255',
            'mobile_number' => 'required|max:20',
            'gender' => 'required',
            'address' => 'string|max:255',
            'status' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);


        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        try {
            DB::beginTransaction();

            // save user to database
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->role = 'teacher';
            $user->last_name = $request->last_name;
            $user->mobile_number = $request->mobile_number;
            $user->gender = $request->gender;
            $user->address = $request->address;

            if ($request->joining_date) {
                $user->joining_date = $request->joining_date;
            }
            if ($request->marital_status) {
                $user->marital_status = $request->marital_status;
            }
            if ($request->qualification) {
                $user->qualification = $request->qualification;
            }
            if ($request->work_experience) {
                $user->work_experience = $request->work_experience;
            }
            if ($request->note) {
                $user->note = $request->note;
            }
            $user->save();



            DB::commit();

            return redirect()->route('teacher.index')->with('success', 'Teacher created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $teacher, $id)
    {
        $teacher = User::getTeacher($id);
        return view('admin.teacher.edit', [
            'title' => 'Edit Teacher',
            'teacher' => $teacher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // validate request
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'last_name' => 'string|max:255',
            'mobile_number' => 'required|max:20',
            'gender' => 'required',
            'address' => 'max:255',
            'status' => 'required'
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        try {
            DB::beginTransaction();

            // save user to database
            $user = User::getTeacher($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->status = $request->status;
            $user->last_name = $request->last_name;
            $user->mobile_number = $request->mobile_number;
            $user->gender = $request->gender;
            $user->address = $request->address;

            if ($request->joining_date) {
                $user->joining_date = $request->joining_date;
            }
            if ($request->marital_status) {
                $user->marital_status = $request->marital_status;
            }
            if ($request->qualification) {
                $user->qualification = $request->qualification;
            }
            if ($request->work_experience) {
                $user->work_experience = $request->work_experience;
            }
            if ($request->note) {
                $user->note = $request->note;
            }
            $user->save();

            DB::commit();

            return redirect()->route('teacher.index')->with('success', 'Teacher Updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function editStudents(Request $request, $id)
    {
        $teacherStudents = User::getTeacherStudents($id);
        $students = User::getNotTeacherStudents($id);
        return view('admin.teacher.teacherStudentEdit', [
            'title' => 'Edit Teacher Students',
            'teacherId' => $id,
            'teacherStudents' => $teacherStudents,
            'students' => $students

        ]);
    }

    public function addStudent(Request $request, $id, $studentId)
    {
        try {
            $user = User::getTeacher($id);
            $student = User::getStudent($studentId);

            if (!$user || !$student) {
                return redirect()->back()->with('error', 'Teacher or Student not found');
            }

            if ($student->teacher_id != null) {
                return redirect()->back()->with('error', 'Student already has a teacher');
            }

            $student->teacher_id = $user->id;
            $student->save();

            return redirect()->back()->with('success', 'Student added successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function removeStudent(Request $request, $id, $studentId)
    {
        try {
            $user = User::getTeacher($id);
            $student = User::getStudent($studentId);

            if (!$user || !$student) {
                return redirect()->back()->with('error', 'Teacher or Student not found');
            }

            $student->teacher_id = null;
            $student->save();

            return redirect()->back()->with('success', 'Student removed successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $teacher, $id)
    {
        $user = User::getTeacher($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Teacher not found');
        }
        $user->delete();
        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully');
    }
}
