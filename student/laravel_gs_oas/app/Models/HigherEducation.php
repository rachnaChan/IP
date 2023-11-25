<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApplicantDetail;

class HigherEducation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'higher_educations';

    protected $fillable = [
        'institution',
        'province',
        'country',
        'major',
        'degree_obtained',
        'degree_start_date',
        'degree_end_date',
        'applicant_id',
    ];

    public function applicantDetailHigherEducation()
    {
        return $this->belongsTo(ApplicantDetail::class);
    }
}
