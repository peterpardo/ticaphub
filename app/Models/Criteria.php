<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'criteria';
    protected $fillable = [
        'name',
        'percentage',
        'rubric_id',
    ];

    public function rubric() {
        return $this->belongsTo(Rubric::class, 'rubric_id', 'id');
    }
    public function groupGrades() {
        return $this->hasMany(GroupGrade::class, 'criteria_id', 'id');
    }
}
