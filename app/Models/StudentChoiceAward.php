<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentChoiceAward extends Model
{
    use HasFactory;

    protected $table = 'student_choice_awards';
    protected $fillable = [
        'name',
        'specialization_id',
        'ticap_id',
    ];

    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function ticap() {
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
}
