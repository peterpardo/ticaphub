<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = [
        'name',
    ];

    // public function users() {
    //     return $this->belongsToMany(User::class, 'candidates', 'position_id', 'user_id')
    //         ->withPivot('id');
    // }

    public function userSchool() {
        return $this->hasOneThrough(School::class, User::class);
    }

    public function candidates() {
        return $this->hasMany(Candidate::class, 'position_id', 'id');
    }

    public function positionHasRole() {
        return $this->hasOne(PositionHasRole::class, 'position_id', 'id');
    }

    public function officer() {
        return $this->hasOne(Officer::class, 'position_id' ,'id');
    }
}
