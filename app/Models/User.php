<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getAdmins()
    {
        $user = self::where('role', 'admin');


        // check if email and name is searched
        $requestedEmail = Request::get('email');
        $requestedName = Request::get('name');
        $requestedDate = Request::get('date');

        if ($requestedEmail) {
            $user = $user->where('email', 'like', '%' . $requestedEmail . '%');
        }
        if ($requestedName) {
            $user = $user->where('name', 'like', '%' . $requestedName . '%');
        }
        if ($requestedDate) {
            $user = $user->whereDate('created_at',  $requestedDate);
        }

        // pagination
        $user = $user->orderBy('updated_at', 'desc')->paginate(10);
        return $user;
    }
    static public function getStudents()
    {
        $user = self::select('users.*', 'courses.name as course_name')->join('courses', 'courses.id', '=', 'users.course_id', 'left')->where('users.role', 'student');


        // check if email and name is searched
        $requestedName = Request::get('name');
        $requestedEmail = Request::get('email');
        $requestedCourse = Request::get('course');
        $requestedRollNumber = Request::get('roll_number');
        $requestedAdmissionDate = Request::get('admission_date');
        $requestedStatus = Request::get('status');
        $requestedReligion = Request::get('religion');

        if ($requestedEmail) {
            $user = $user->where('users.email', 'like', '%' . $requestedEmail . '%');
        }
        if ($requestedName) {
            $user = $user->where('users.name', 'like', '%' . $requestedName . '%');
        }
        if ($requestedCourse) {
            $user = $user->where('users.course_id', 'like', '%' . $requestedCourse . '%');
        }
        if ($requestedRollNumber) {
            $user = $user->where('users.roll_number', 'like', '%' . $requestedRollNumber . '%');
        }
        if ($requestedAdmissionDate) {
            $user = $user->whereDate('users.admission_date',  $requestedAdmissionDate);
        }
        if ($requestedStatus) {
            $user = $user->where('users.status',  $requestedStatus);
        }
        if ($requestedReligion) {
            $user = $user->where('users.religion', 'like', '%' .  $requestedReligion . '%');
        }

        // pagination
        $user = $user->orderBy('users.updated_at', 'desc')->paginate(8);
        return $user;
    }
    static public function getActiveStudent($studentId)
    {
        return self::where('role', 'student')->where('id', $studentId)->where('status', 'active')->first();
    }
    public static function getGuardians()
    {
        $query = self::select('users.*', 'users.name as guardian_name')
            ->leftJoin('users as guardians', 'users.id', '=', 'guardians.guardian_id')
            ->where('users.role', 'guardian');

        // Check if email, name, and status are searched
        $requestedEmail = request('email');
        $requestedName = request('name');
        $requestedGender = request('gender');
        $requestedStatus = request('status');
        $requestedCreatedDate = request('created_at');

        if ($requestedEmail) {
            $query->where('users.email', 'like', '%' . $requestedEmail . '%');
        }

        if ($requestedName) {
            $query->where('users.name', 'like', '%' . $requestedName . '%');
        }

        if ($requestedGender) {
            $query->where('users.gender', $requestedGender);
        }

        if ($requestedStatus) {
            $query->where('users.status', $requestedStatus);
        }
        if ($requestedCreatedDate) {
            $query->whereDate('users.created_at', $requestedCreatedDate);
        }

        // Pagination
        $result = $query->orderBy('users.updated_at', 'desc')->paginate(8);

        return $result;
    }

    public static function getTeachers()
    {
        $query = self::select('users.*', 'users.name as guardian_name')
            // ->leftJoin('users as guardians', 'users.id', '=', 'guardians.guardian_id')
            ->where('users.role', 'teacher');

        // Check if email, name, and status are searched
        $requestedEmail = request('email');
        $requestedName = request('name');
        $requestedGender = request('gender');
        $requestedStatus = request('status');
        $requestedCreatedDate = request('created_at');

        if ($requestedEmail) {
            $query->where('users.email', 'like', '%' . $requestedEmail . '%');
        }

        if ($requestedName) {
            $query->where('users.name', 'like', '%' . $requestedName . '%');
        }

        if ($requestedGender) {
            $query->where('users.gender', $requestedGender);
        }

        if ($requestedStatus) {
            $query->where('users.status', $requestedStatus);
        }
        if ($requestedCreatedDate) {
            $query->whereDate('users.created_at', $requestedCreatedDate);
        }

        // Pagination
        $result = $query->orderBy('users.updated_at', 'desc')->paginate(8);

        return $result;
    }
    public static function getTeacherById($id)
    {
        return User::where('role', 'teacher')->where('id', $id)->first();
    }
    static public function getActiveTeachers()
    {
        return  User::where('status', 'active')->where('role', 'teacher')->get();
    }
    static public function getTeacherStudents($teacherId)
    {
        return User::select('users.*', '')->join('courses', 'courses.id', '=', 'users.course_id')
            ->join('assign_class_subjects', 'assign_class_subjects.course_id', '=', 'courses.id')
            ->join('');
    }
    static public function getGuardianStudents($guardianId)
    {
        $user = User::select(
            'users.*',
            'courses.name as course_name'
        )
            ->leftJoin('courses', 'courses.id', '=', 'users.course_id')
            ->where('guardian_id', $guardianId);
        return $user->get();
    }
    static public function getNotGuardianStudents($guardianId)
    {
        return User::where('role', 'student')
            ->where(function ($query) use ($guardianId) {
                $query->whereNull('guardian_id')
                    ->orWhere('guardian_id', '!=', $guardianId);
            })
            ->get();
    }

    static  public function getEmailSingle($email)
    {
        return User::where('email',  $email)->first();
    }

    static public function getStudent($id)
    {
        return User::where('id', $id)->where('role', 'student')->first();
    }
    static public function getGuardian($id)
    {
        return User::where('id', $id)->where('role', 'guardian')->first();
    }
    static public function getTeacher($id)
    {
        return User::where('id', $id)->where('role', 'teacher')->first();
    }

    static public function getIdSingle(int $id)
    {
        return User::where('id', $id)->first();
    }
    static public function getTokenSingle($token)
    {
        return User::where('remember_token',  Str::lower($token))->first();
    }
    public function files()
    {
        return $this->hasMany(File::class, 'auth_by')->latest();
    }
}
