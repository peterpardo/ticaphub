<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'specialization_id',
        'school_id',
    ];

    public function userGroups() {
        return $this->hasMany(UserGroup::class, 'group_id', 'id');
    }

    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    public function school() {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
}
