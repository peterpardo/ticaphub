<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';

    protected $fillable = [
        'name',
        'is_involved',
    ];

    public function user() {
        return $this->hasMany(User::class, 'school_id', 'id');
    }

    public function groups() {
        return $this->hasMany(Group::class, 'school_id', 'id');
    }

    public function candidates() {
        return $this->hasMany(Candidate::class, 'school_id', 'id');
    }
}
