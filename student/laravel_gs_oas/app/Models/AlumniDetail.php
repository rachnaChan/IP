<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Program;

class AlumniDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'graduate_date',
        'program_id',
        'job_title',
        'company',
        'salary_range' 
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'alumni_id'); 
    }

    public function program()
    {
        return $this->belongsTo(Program::class); 
    }

}
