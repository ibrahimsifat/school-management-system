<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'status',
        "type",
        'created_by',
        'updated_by'
    ];
    static public function getAllSubjects()
    {
        $subjects = Subject::select('subjects.*', 'users.name as created_by')
            ->join('users', 'users.id', '=', 'subjects.created_by');

        // check if email and name is searched
        $requestedStatus = Request::get('status');
        $requestedType = Request::get('type');
        $requestedName = Request::get('name');
        $requestedDate = Request::get('date');

        if ($requestedStatus) {
            $subjects = $subjects->where('subjects.status',  $requestedStatus);
        }
        if ($requestedType) {
            $subjects = $subjects->where('subjects.type',  $requestedType);
        }
        if ($requestedName) {
            $subjects = $subjects->where('subjects.name', 'like', '%' . $requestedName . '%');
        }
        if ($requestedDate) {
            $subjects = $subjects->whereDate('subjects.created_at',  $requestedDate);
        }
        return $subjects->orderBy('subjects.id', 'desc')
            ->paginate(10);
    }
    static public function getActiveSubjects()
    {
        return  Subject::where('status', 'active')->get();
    }

    static public function getSubjectById($id)
    {
        return Subject::find($id);
    }
}
