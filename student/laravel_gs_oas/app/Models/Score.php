<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ApplicantDetail;

class Score extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'transcript',
        'language',
        'motivation_letter',
        'recommendation_letter',
        'cv',
        'related_experience',
        'educational_background',
        'applicant_id',
        'head_of_program_id'
    ];

    public function headOfProgramScore()
    {
        return $this->belongsTo(User::class);
    }

    public function applicantDetailScore()
    {
        return $this->belongsTo(AppplicantDetail::class);
    }
}
