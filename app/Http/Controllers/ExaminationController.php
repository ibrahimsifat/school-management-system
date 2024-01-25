<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Http\Requests\StoreExaminationRequest;
use App\Http\Requests\UpdateExaminationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examinations = Examination::getExaminations();
        return view('admin.examination.index', [
            'title' => 'Examinations',
            'examinations' => $examinations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.examination.create', [
            'title' => 'Create Examination',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExaminationRequest $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'status' => 'required',
                'type' => 'required'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }
            $examination = new Examination();
            $examination->name = $request->name;
            $examination->note = $request->note;
            $examination->status = $request->status;
            $examination->type = $request->type;
            $examination->created_by = Auth::user()->id;
            $examination->save();
            return redirect()->route('examination.index')->with('success', 'Examination Created Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Examination $examination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Examination $examination, $id)
    {
        $examination = Examination::getExaminationById($id);
        if (!$examination)
            return redirect()->route('examination.index')->with('error', 'Examination Not Found');

        return view('admin.examination.edit', [
            'title' => 'Edit Examination',
            'examination' => $examination
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExaminationRequest $request, Examination $examination, $id)
    {
        $examination = Examination::getExaminationById($id);

        if (!$examination)
            return redirect()->route('examination.index')->with('error', 'Examination Not Found');

        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'status' => 'required',
                'type' => 'required'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }
            $examination->name = $request->name;
            $examination->note = $request->note;
            $examination->status = $request->status;
            $examination->type = $request->type;
            $examination->updated_by = Auth::user()->id;
            $examination->save();
            return redirect()->route('examination.index')->with('success', 'Examination Updated Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Examination $examination, $id)
    {
        try {
            $examination = Examination::getExaminationById($id);

            if (!$examination)
                return redirect()->route('examination.index')->with('error', 'Examination Not Found');

            $examination->delete();
            return redirect()->route('examination.index')->with('success', 'Examination Deleted Successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
