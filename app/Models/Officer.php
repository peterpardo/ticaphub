<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $table = 'officers';

    protected $fillable = [
        'candidate_id',
        'is_elected',
        'ticap_id'
    ];

    public function candidate(){
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
}
