<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpecialization extends Model
{
    use HasFactory;

    protected $table = 'user_specialization';
    
    protected $fillable = [
        'specialization_id',
        'has_voted',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

}
