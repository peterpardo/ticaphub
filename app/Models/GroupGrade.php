<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupGrade extends Model
{
    use HasFactory;

    protected $table = 'group_grade';
    protected $fillable = [
        'group_id',
        'criteria_id',
        'grade',
        'award_id',
    ];

    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
    public function criteria() {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'id');
    }
    public function award() {
        return $this->belongsTo(Award::class, 'award_id', 'id');
    }
}
