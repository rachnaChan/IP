<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApplicantDetail;

class ForeignLanguage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'certificate',
        'date_of_received',
        'reading',
        'writing',
        'listening',
        'speaking',
        'applicant_id'
    ];

    public function applicantDetailForeignLanguage()
    {
        return $this->belongsTo(ApplicantDetail::class);
    }
}
