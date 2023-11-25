<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use App\Models\Enrollment;
use App\Models\User;

class StudentDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'enrollment_date',
        'program_id',
        'academic_year',
    ];

    public function enrollment()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function programStudentDetail()
    {
        return $this->belongsTo(Program::class);
    }

    public function user()
    {
        return $this->hasOne(User::class,'student_id')->with(['enrollments']);
    }
}
