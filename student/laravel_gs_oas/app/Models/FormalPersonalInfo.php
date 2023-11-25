<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApplicantDetail;

class FormalPersonalInfo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type_of_degree',
        'study_pathway',
        'image',
        'family_name',
        'given_name',
        'gender',
        'marital_status',
        'dob',
        'place_of_birth',
        'country_of_birth',
        'nationality',
        'registration_level',
        'khmer_name',
    ];
    
    
    public function applicantDetail()
    {
        return $this->hasOne(ApplicantDetail::class);
    }
}

