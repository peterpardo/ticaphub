<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserElection extends Model
{
    use HasFactory;

    protected $table = 'user_election';
    protected $fillable = [
        'user_id',
        'election_id',
        'has_voted'
    ];

    public function election() {
        return $this->belongsTo(Election::class, 'election_id', 'id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
