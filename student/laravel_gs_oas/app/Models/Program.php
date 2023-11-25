<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\User;
use App\Models\ApplicantDetail;
use App\Models\StudentDetail;

class Program extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'head_of_program_id',
        'image'
    ];

    public function applicantDetail()
    {
        return $this->hasMany(ApplicantDetail::class);
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function headOfProgram()
    {
        return $this->belongsTo(User::class, 'head_of_program_id');
    }

    public function studentDetail(){
        return $this->hasMany(StudentDetail::class)->with(['user']);
    }
}
