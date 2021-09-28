<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $fillable = [
        'user_id',
        'position_id',
        'election_id',
        'is_done'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function position() {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
    public function election() {
        return $this->belongsTo(Election::class, 'election_id', 'id');
    }
    public function votes() {
        return $this->hasMany(Vote::class, 'candidate_id', 'id');
    }
}
