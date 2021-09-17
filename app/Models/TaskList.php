<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $table = 'tasklists';

    protected $fillable = [
        'title',
        'user_id',
        'event_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }   

    public function event(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

}
