<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LecturerDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'hired_date'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
