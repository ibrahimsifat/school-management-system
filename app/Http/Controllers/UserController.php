<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function changePassword()
    {
        return view('profile.changePassword', [
            'title' => 'Change Password'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = User::getIdSingle(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully');
        } else {
            return redirect()->back()->with('error', 'Old Password is incorrect');
        }
    }
    public function editMyAccount()
    {
        $user = Auth::user();
        if ($user->role == 'student') {
            return view('student.myAccount', [
                'title' => 'My Account',
                'student' => $user,
            ]);
        } elseif ($user->role == 'teacher') {
            return view('teacher.myAccount', [
                'title' => 'My Account',
                'teacher' => $user,
            ]);
        } elseif ($user->role == 'guardian') {
            return view('guardian.myAccount', [
                'title' => 'My Account',
                'guardian' => $user,
            ]);
        } elseif ($user->role == 'admin') {
            return view('admin.admin.myAccount', [
                'title' => 'My Account',
                'user' => $user,
            ]);
        }
    }
    public function updateTeacherAccount(Request $request)
    {
        $id = Auth::user()->id;
        // validate request
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'last_name' => 'string|max:255',
            'mobile_number' => 'required|max:20',
            'gender' => 'required',
            'address' => 'max:255',
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
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Account Updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStudentAccount(Request $request,)
    {
        try {
            $id = Auth::user()->id;
            $user = User::getIdSingle($id);
            if (!$user) {
                return redirect()->back()->with('error', 'Student not found');
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|email|unique:users,email,' . $id,
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
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->caste = $request->caste;
            $user->religion = $request->religion;
            $user->mobile_number = $request->mobile_number;
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

    public function updateGuardianAccount(Request $request)
    {
        $id = Auth::user()->id;
        // validate request
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'string|max:255',
            'mobile_number' => 'required|max:20',
            'gender' => 'required',
            'occupation' => 'string|max:50',
            'address' => 'string|max:255',
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
            $user->last_name = $request->last_name;
            $user->mobile_number = $request->mobile_number;
            $user->gender = $request->gender;
            $user->occupation = $request->occupation;
            $user->address = $request->address;
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Guardian Updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateAdminAccount(Request $request)
    {
        $id = Auth::user()->id;
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // if validation fails
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $user = User::getIdSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Admin updated successfully');
    }
}
