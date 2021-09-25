<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    public $table = 'awards';
    public $fillable = [
        'name',
        'type',
        'specialization_id',
        'school_id',
        'ticap_id',
    ];

    public function specialization(){
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function school(){
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
    public function ticap(){
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
}
