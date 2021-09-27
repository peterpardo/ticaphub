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
        'school_id',
    ];

    public function election() {
        return $this->hasOne(Election::class, 'specialization_id', 'id');
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
    public function userSpecialization() {
        return $this->hasMany(UserProgram::class, 'specialization_id', 'id');
    }
    public function awards(){
        return $this->hasMany(Award::class, 'specialization_id', 'id');
    }
}
