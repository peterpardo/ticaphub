<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'description',
        'user_id',
        'task_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function task() {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function files() {
        return $this->hasMany(File::class, 'activity_id', 'id');
    }
}
