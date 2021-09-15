<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $fillable = [
        'user_id',
        'position_id',
        'specialization_id',
        'school_id',
        'is_done'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function position() {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    public function school() {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }


    public function officer() {
        return $this->hasOne(Officer::class, 'candidate_id', 'id');
    }

}
