<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualAwardCandidate extends Model
{
    use HasFactory;

    protected $table = 'individual_award_candidates';
    protected $fillable = [
        'user_id',
        'group_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
