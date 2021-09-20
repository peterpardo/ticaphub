<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $table = 'officers';

    protected $fillable = [
        'user_id',
        'is_elected',
        'ticap_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
