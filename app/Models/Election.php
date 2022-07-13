<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $table = 'elections';
    protected $fillable = [
        'name',
        'specialization_id',
        'ticap_id',
        'status'
    ];

    public $statusColor = [
        'not started' => 'red',
        'in progress' => 'blue',
        'done' => 'green',
    ];

    public function positions() {
        return $this->hasMany(Position::class, 'election_id', 'id');
    }

    public function officers() {
        return $this->hasMany(Officer::class, 'election_id', 'id');
    }
    public function candidates() {
        return $this->hasMany(Candidate::class, 'election_id', 'id');
    }
    public function specialization() {
        return $this->hasMany(Specialization::class, 'election_id', 'id');
    }
    public function userElections() {
        return $this->hasMany(UserElection::class, 'election_id', 'id');
    }
    public function ticap() {
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }

    public function votes() {
        return $this->hasMany(Vote::class, 'election_id', 'id');
    }

    public function getStatusColorAttribute() {
        return $this->statusColor[$this->status];
    }
}
