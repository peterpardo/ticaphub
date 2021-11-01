<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    protected $fillable = [
        'name',
        'date',
        'theme'
    ];

    public function attendees() {
        return $this->hasMany(Attendee::class, 'schedule_id', 'id');
    }
    public function users() {
        return $this->belongsToMany(User::class, 'user_schedule', 'schedule_id', 'user_id');
    }
}
