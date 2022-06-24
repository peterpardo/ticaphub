<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';
    protected $fillable = [
        'name',
        'is_involved',
    ];

    public function specializations() {
        return $this->hasMany(Specialization::class, 'school_id', 'id');
    }
    public function user() {
        return $this->hasMany(User::class, 'school_id', 'id');
    }
    public function groups() {
        return $this->hasMany(Group::class, 'school_id', 'id');
    }
    public function candidates() {
        return $this->hasMany(Candidate::class, 'school_id', 'id');
    }
    public function awards(){
        return $this->hasMany(Award::class, 'school_id', 'id');
    }

    public function getSlugNameAttribute() {
        return Str::of($this->name)->slug('-');
    }

    public function scopeActive($query) {
        return $query->where('is_involved', 1);
    }
}
