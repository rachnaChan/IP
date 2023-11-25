<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_name',
        'file_path',
        'file_type',
    ];

     //enum values for file_type's field
     public const TYPE_LESSON = 'Lesson';
     public const TYPE_PERSONAL = 'Personal';
     public const TYPE_ASSIGNMENT= 'Assignment';
     public const TYPE_PROJECT= 'Project';
     public const TYPE_CLASSNOTE= 'ClassNote';



    public function userDocument()
    {
        return $this->belongsTo(User::class);
    }

}
