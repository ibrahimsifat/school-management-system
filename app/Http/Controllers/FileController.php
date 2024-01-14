<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    private $image;
    public function __construct(File $image)
    {
        $this->image = $image;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('file.index', [
            'title' => 'Files',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('file.create', [
            'title' => 'Create File',
        ]);
    }

    public function getImages()
    {
        return view('images')->with('images', auth()->user()->images);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function Upload(StoreFileRequest $request)
    {
        $path = Storage::disk('s3')->put('images/originals', $request->file);
        $request->merge([
            'size' => $request->file->getClientSize(),
            'path' => $path
        ]);
        $this->image->create($request->only('path', 'title', 'size'));
        return back()->with('success', 'Image Successfully Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
