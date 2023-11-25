<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use App\Models\User;
use App\Models\Enrollment;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'program_id',
        'schedule',
        'syllabus',
        'lecturer_id',
        'image',
        'deadline',
        'credit',
        'semester'

    ];

    //*** user here refers to lecturer_id ***/
    public function userCourse()
    {
        return $this->belongsTo(User::class);
    }

    public function programCourse()
    {
        return $this->belongsTo(Program::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
