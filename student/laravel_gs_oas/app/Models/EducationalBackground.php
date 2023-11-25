<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApplicantDetail;

class EducationalBackground extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'itc_graduate_year',
        'major',
        'high_school_grade',
        'high_school_year',
        'high_school_name',
        'high_school_province',
        'high_school_country',

    ];

    public function applicantDetail()
    {
        return $this->hasOne(ApplicantDetail::class);
    }
}
