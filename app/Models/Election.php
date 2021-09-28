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
        'ticap_id'
    ];
    
    public function officers() {
        return $this->hasMany(Officer::class, 'election_id', 'id');
    }
    public function candidates() {
        return $this->hasMany(Candidate::class, 'election_id', 'id');
    }
    public function specialization() {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function userElections() {
        return $this->hasMany(UserElection::class, 'election_id', 'id');
    }
}
