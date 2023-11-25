<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventInfo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'events_info';
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'deadline',
        'image',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
