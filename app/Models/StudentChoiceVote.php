<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentChoiceVote extends Model
{
    use HasFactory;

    protected $table = 'student_choice_votes';
    protected $fillable = [
        'name',
        'email',
        'group_id',
        'specialization_id',
    ];

    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
}
