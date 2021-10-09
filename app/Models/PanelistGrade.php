<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelistGrade extends Model
{
    use HasFactory;

    protected $table = 'panelist_grades';
    protected $fillable = [
        'group_id',
        'total_grade',
        'award_id',
        'user_id',
    ];

    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
    public function award() {
        return $this->belongsTo(Award::class, 'award_id', 'id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
