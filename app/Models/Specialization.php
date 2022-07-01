<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $table = 'specializations';

    protected $fillable = [
        'name',
        'election_id',
        'school_id',
    ];

    public function election() {
        return $this->belongsTo(Election::class, 'election_id', 'id');
    }
    public function groups() {
        return $this->hasMany(Group::class, 'specialization_id', 'id');
    }
    public function school() {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
    public function candidates() {
        return $this->hasMany(Candidate::class, 'specialization_id', 'id');
    }
    public function userSpecializations() {
        return $this->hasMany(UserSpecialization::class, 'specialization_id', 'id');
    }
    public function awards(){
        return $this->hasMany(Award::class, 'specialization_id', 'id');
    }
    public function studentChoiceAwards() {
        return $this->hasMany(StudentChoiceAward::class, 'specialization_id', 'id');
    }
    public function studentVotes() {
        return $this->hasMany(StudentChoiceVote::class, 'specialization_id', 'id');
    }
    public function panelists() {
        return $this->hasMany(SpecializationPanelist::class, 'specialization_id', 'id');
    }
    public function attendance() {
        return $this->hasMany(Attendance::class, 'specialization_id', 'id');
    }
}
