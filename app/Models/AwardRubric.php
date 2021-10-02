<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardRubric extends Model
{
    use HasFactory;

    protected $table = 'award_rubric';
    protected $fillable = [
        'award_id',
        'rubric_id',
    ];

    public function award() {
        return $this->belongsTo(Award::class, 'award_id', 'id');
    }
    public function rubric() {
        return $this->belongsTo(Rubric::class, 'rubric_id', 'id');
    }
}
