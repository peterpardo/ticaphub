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

    public function userProgram() {
        return $this->hasMany(UserProgram::class, 'school_id', 'id');
    }

    public function groups() {
        return $this->hasMany(Group::class, 'school_id', 'id');
    }
}
