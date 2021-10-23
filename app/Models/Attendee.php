<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    protected $table = 'attendees';
    protected $fillable = [
        'name',
        'schedule_id',
    ];

    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
}
