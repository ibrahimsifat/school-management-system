<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Examination extends Model
{
    use HasFactory;

    static public function getExaminations()
    {
        $perPage = 10;

        // Get examinations by pagination
        $result = Examination::select('examinations.*', 'users.name as created_by_name', 'users.role as created_by_role')
            ->join('users', 'users.id', '=', 'examinations.created_by');

        // check if email and name is searched
        $requestedStatus = Request::get('status');
        $requestedType = Request::get('type');
        $requestedName = Request::get('name');
        $requestedDate = Request::get('date');

        if ($requestedStatus) {
            $result = $result->where('examinations.status',  $requestedStatus);
        }
        if ($requestedType) {
            $result = $result->where('examinations.type',  $requestedType);
        }
        if ($requestedName) {
            $result = $result->where('examinations.name', 'like', '%' . $requestedName . '%');
        }
        if ($requestedDate) {
            $result = $result->whereDate('examinations.created_at',  $requestedDate);
        }

        return $result->orderBy('examinations.id', 'desc')
            ->paginate($perPage);
    }


    static public function getExaminationById($id)
    {
        // get examination by id
        return Examination::find($id);
    }
}
