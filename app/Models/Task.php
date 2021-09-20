<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'list_id',
        'user_id',
    ];

    public function taskCreator() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_task', 'task_id', 'user_id')
            ->withTimestamps();
    }

    public function activities(){
        return $this->hasMany(Activity::class, 'task_id', 'id');
    }
}
