<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApplicantDetail;

class CurrentContactInfo extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'address',
        'postal_code',
        'province',
        'country',
        'phone_number',
        'email'
    ];
     
    public function applicantDetail()
    {
        return $this->hasOne(ApplicantDetail::class);
    }
}
