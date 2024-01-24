<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardians = User::getGuardians();
        return view('admin.guardian.index', [
            'title' => 'Guardians',
            'guardians' => $guardians
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::getStudents();
        return view('admin.guardian.create', [
            'title' => 'Create Guardian',
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
            'occupation' => 'string|max:50',
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
            $user->role = 'guardian';
            $user->last_name = $request->last_name;
            $user->mobile_number = $request->mobile_number;
            $user->gender = $request->gender;
            $user->occupation = $request->occupation;
            $user->address = $request->address;
            $user->save();

            // Loop through selected student IDs
            foreach ($request->input('student_id', []) as $studentId) {
                $student = User::getStudent($studentId);

                if ($student && $student->guardian_id == null) {
                    $student->guardian_id = $user->id;
                    $student->save();
                } else {
                    // Rollback the user creation and return an error
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Student not found or already has a guardian');
                }
            }


            DB::commit();

            return redirect()->route('guardian.index')->with('success', 'Guardian created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $guardian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $guardian, $id)
    {
        $guardian = User::getGuardian($id);
        return view('admin.guardian.edit', [
            'title' => 'Edit Guardian',
            'guardian' => $guardian,
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
            'last_name' => 'string|max:255',
            'mobile_number' => 'required|max:20',
            'gender' => 'required',
            'occupation' => 'string|max:50',
            'address' => 'string|max:255',
            'status' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        try {
            DB::beginTransaction();

            // save user to database
            $user = User::getGuardian($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->status = $request->status;
            $user->last_name = $request->last_name;
            $user->mobile_number = $request->mobile_number;
            $user->gender = $request->gender;
            $user->occupation = $request->occupation;
            $user->address = $request->address;
            $user->save();

            DB::commit();

            return redirect()->route('guardian.index')->with('success', 'Guardian Updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function editStudents(Request $request, $id)
    {
        $guardianStudents = User::getGuardianStudents($id);
        $students = User::getNotGuardianStudents($id);
        return view('admin.guardian.guardianStudentEdit', [
            'title' => 'Edit Guardian Students',
            'guardianId' => $id,
            'guardianStudents' => $guardianStudents,
            'students' => $students

        ]);
    }

    public function addStudent(Request $request, $id, $studentId)
    {
        try {
            $user = User::getGuardian($id);
            $student = User::getStudent($studentId);

            if (!$user || !$student) {
                return redirect()->back()->with('error', 'Guardian or Student not found');
            }

            if ($student->guardian_id != null) {
                return redirect()->back()->with('error', 'Student already has a guardian');
            }

            $student->guardian_id = $user->id;
            $student->save();

            return redirect()->back()->with('success', 'Student added successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function removeStudent(Request $request, $id, $studentId)
    {
        try {
            $user = User::getGuardian($id);
            $student = User::getStudent($studentId);

            if (!$user || !$student) {
                return redirect()->back()->with('error', 'Guardian or Student not found');
            }

            $student->guardian_id = null;
            $student->save();

            return redirect()->back()->with('success', 'Student removed successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $guardian, $id)
    {
        $user = User::getGuardian($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Guardian not found');
        }
        $user->delete();
        return redirect()->route('guardian.index')->with('success', 'Guardian deleted successfully');
    }
}
