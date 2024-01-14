<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::getAllSubjects();
        return view('admin.subject.index', [
            'title' => 'Subjects',
            'subjects' => $subjects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.create', [
            'title' => 'Create Subject',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'status' => 'required',
                'type' => 'required'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }
            $subject = new Subject();
            $subject->name = $request->name;
            $subject->description = $request->description;
            $subject->status = $request->status;
            $subject->type = $request->type;
            $subject->slug = str_replace(' ', '-', strtolower($request->name));
            $subject->created_by = Auth::user()->id;
            $subject->save();
            return redirect()->route('subject.index')->with('success', 'Subject Created Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Subject $subject)
    {
        $subject = Subject::getSubjectById($id);
        if (!$subject)
            return redirect()->route('subject.index')->with('error', 'Subject Not Found');
        return view('admin.subject.edit', [
            'title' => 'Edit Subject',
            'subject' => $subject
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, UpdateSubjectRequest $request, Subject $subject)
    {
        $subject = Subject::getSubjectById($id);

        if (!$subject)
            return redirect()->route('subject.index')->with('error', 'Subject Not Found');

        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'status' => 'required',
                'type' => 'required'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }
            $subject->name = $request->name;
            $subject->description = $request->description;
            $subject->status = $request->status;
            $subject->type = $request->type;
            $subject->slug = str_replace(' ', '-', strtolower($request->name));
            $subject->save();
            return redirect()->route('subject.index')->with('success', 'Subject Updated Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Subject $subject)
    {
        $subject = Subject::getSubjectById($id);

        if (!$subject)
            return redirect()->route('subject.index')->with('error', 'Subject Not Found');
        try {
            $subject->delete();
            return redirect()->route('subject.index')->with('success', 'Subject Deleted Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
