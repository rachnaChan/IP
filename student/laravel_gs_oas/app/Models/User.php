<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Document;
use App\Models\Feedback;
use App\Models\Program;
use App\Models\EventInfo;
use App\Models\ApplicantDetail;
use App\Models\StudentDetail;
use App\Models\LecturerDetail;
use App\Models\Score;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'role_id',
        'applicant_id',
        'student_id',
        'lecturer_id',
        'image',
        'gender',
        'dob',
        'bio',
        'phone_number'
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

    public function sendPasswordResetNotification($token)
    {
        //this url will send to the user email address it should specify the url of front-end client
        // $url = 'http://localhost:8000/api/reset-password?token=' . $token;
        $url = 'http://localhost:5173/newPassword?token=' . $token;
        $this->notify(new ResetPasswordNotification($url));
    }

    public function roleUser()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function document()
    {
        return $this->hasMany(Document::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function lecturerDetailUser()
    {
        return $this->belongsTo(LecturerDetail::class);
    }

    public function headOfProgram()
    {
        return $this->hasOne(Program::class, 'head_of_program_id');
    }

    public function score()
    {
        return $this->hasMany(Score::class);
    }

    public function applicantDetailUser()
    {
        return $this->belongsTo(ApplicantDetail::class);
    }

    public function studentDetailUser()
    {
        return $this->belongsTo(StudentDetail::class, 'id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id')->with(['course']);
    }

    // public function eventInfo()
    // {
    //     return $this->hasMany(EventInfo::class);
    // }


}
