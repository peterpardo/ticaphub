<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionHasRole extends Model
{
    use HasFactory;

    protected $table = 'position_has_role';

    protected $fillable = [
        'role_id'
    ];

    public function position(){
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}
