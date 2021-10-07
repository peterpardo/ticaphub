<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializationPanelist extends Model
{
    use HasFactory;

    protected $table = 'specialization_panelist';
    protected $fillable = [
        'user_id',
        'specialization_id',
        'is_done'
    ];

    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
