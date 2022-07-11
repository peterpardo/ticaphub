<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = [
        'name',
        'election_id',
        'is_done',
    ];

    public function election() {
        return $this->belongsTo(Election::class, 'election_id', 'id');
    }

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

    public function getNameAttribute($value) {
        return ucwords($value);
    }

    public function getPositionSlugAttribute() {
        return Str::slug($this->name, '_');
    }
}
