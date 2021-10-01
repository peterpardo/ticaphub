<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    use HasFactory;

    protected $table = 'committee_member';
    protected $fillable = [
        'committee_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function committee() {
        return $this->belongsTo(Committee::class, 'committee_id', 'id');
    }
}
