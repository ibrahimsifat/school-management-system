<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::getAdmins();
        return view('admin.admin.index', [
            'title' => 'Admin',
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.create', [
            'title' => 'Create Admin',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]);


            // if validation fails
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }


            $user = new User();
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->password = Hash::make($request->password);
            $user->role = 'admin';
            $user->save();
            return redirect()->route('admin.index')->with('success', 'Admin created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::getIdSingle($id);
        return view('admin.admin.edit', [
            'title' => 'Edit Admin',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

        return redirect()->route('admin.index')->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::getIdSingle($id);
        // if ($user->role == 'admin') {
        //     return redirect()->back()->with('error', 'You can not delete admin');
        // }
        Auth::user()->role == 'admin' ? '' : redirect()->back()->with('error', 'You are not authorized to delete admin');

        Auth::user()->id == $user->id ? redirect()->back()->with('error', 'You can not delete yourself') : '';

        $user->delete();
        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Please select at least one admin');
        }
        dd($ids);
        try {
            foreach ($ids as $id) {
                $user = User::getIdSingle($id);

                // if ($user->role == 'admin') {
                //     return redirect()->back()->with('error', 'You can not delete admin');
                // }

                Auth::user()->role == 'admin' ? '' : redirect()->back()->with('error', 'You are not authorized to delete admin');

                Auth::user()->id == $user->id ? redirect()->back()->with('error', 'You can not delete yourself') : '';

                $user->delete();
            }
            return redirect()->route('admin.index')->with('success', 'Admins deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
