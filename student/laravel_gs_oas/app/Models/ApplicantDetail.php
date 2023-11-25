<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use App\Models\FormalPersonalInfo;
use App\Models\CurrentContactInfo;
use App\Models\SecondaryContactInfo;
use App\Models\EducationalBackground;
use App\Models\ForeignLanguage;
use App\Models\HigherEducation;
use App\Models\WorkExperience;
use App\Models\User;

class ApplicantDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_status',
        'applicant_score',
        'program_id',
        'formal_personal_info_id',
        'current_contact_info_id',
        'secondary_contact_info_id',
        'educational_background_id',
        'declaration',
        'academic_year',
    ];

    //*** naming convention function for belongsTo relationship (foreign_key)(table_name) ***

    public function programApplicantDetail()
    {
        return $this->belongsTo(Program::class);
    }

    public function formalPersonalInfoApplicantDetail()
    {
        return $this->belongsTo(FormalPersonalInfo::class);
    }

    public function currentContactInfoApplicantDetail()
    {
        return $this->belongsTo(CurrentContactInfo::class);
    }

    public function secondaryContactInfoApplicantDetail()
    {
        return $this->belongsTo(SecondaryContactInfo::class);
    }

    public function educationalBackgroundApplicantDetail()
    {
        return $this->belongsTo(EducationalBackground::class);
    }

    public function foreignLanguage()
    {
        return $this->hasMany(ForeignLanguage::class);
    }

    public function higherEducation()
    {
        return $this->hasMany(HigherEducation::class);
    }

    public function workExperience()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'applicant_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'applicant_id');
    }
}
