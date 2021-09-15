<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgram extends Model
{
    use HasFactory;

    protected $table = 'users_program';
    
    protected $fillable = [
        'specialization_id',
        'school_id',
        'has_voted',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function school() {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
    
    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

}
