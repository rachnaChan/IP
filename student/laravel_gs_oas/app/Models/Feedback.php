<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ApplicantDetail;

class Feedback extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'feedbacks';

    protected $fillable = [
        'feedback',
        'user_id',
        'applicant_id'
    ];

    public function userFeedback()
    {
        return $this->belongsTo(User::class);
    }

    public function applicantDetailFeedback()
    {
        return $this->belongsTo(ApplicantDetail::class, 'applicant_id');
    }
}
