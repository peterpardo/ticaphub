<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeTask extends Model
{
    use HasFactory;

    protected $table = 'committee_task';
    protected $fillable = [
        'title',
        'description',
        'committee_id',
        'status',
    ];

    public function committee() {
        return $this->belongsTo(Committee::class, 'committee_id', 'id');
    }
    public function users() {
        return $this->belongsToMany(User::class, 'member_task', 'task_id', 'user_id')
            ->withPivot('is_read')
            ->withTimestamps();
    }
}
