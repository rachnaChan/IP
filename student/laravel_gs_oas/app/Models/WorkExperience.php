<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApplicantDetail;

class WorkExperience extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date_from',
        'date_to',
        'company_name',
        'position',
        'description',
        'applicant_id'
    ];

    public function applicantDetailWorkExperience()
    {
        return $this->belongsTo(ApplicantDetail::class);
    }
}
