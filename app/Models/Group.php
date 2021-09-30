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
        'ticap_id'
    ];

    public function groupExhibit() {
        return $this->hasOne(GroupExhibit::class, 'group_id', 'id');
    }
    public function userGroups() {
        return $this->hasMany(UserGroup::class, 'group_id', 'id');
    }
    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
}
