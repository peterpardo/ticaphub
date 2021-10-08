<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupWinner extends Model
{
    use HasFactory;

    protected $table = 'group_winners';
    protected $fillable = [
        'group_id',
        'award_id',
    ];

    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
    public function award() {
        return $this->belongsTo(Award::class, 'award_id', 'id');
    }
}
