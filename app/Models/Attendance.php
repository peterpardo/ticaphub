<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'specialization_id',
        'event_id',
    ];

    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
