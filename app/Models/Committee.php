<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $table = "committees";
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function committeeMembers() {
        return $this->hasMany(CommitteeMember::class, 'committee_id', 'id');
    }
    public function tasks() {
        return $this->hasMany(CommitteeTask::class, 'committee_id', 'id');
    }
}
