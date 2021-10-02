<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;

    protected $table = 'rubrics';
    protected $fillable = [
        'name'
    ];

    public function criteria() {
        return $this->hasMany(Criteria::class, 'rubric_id', 'id');
    }
    public function awardRubrics() {
        return $this->hasMany(AwardRubric::class, 'rubric_id', 'id');
    }
}
