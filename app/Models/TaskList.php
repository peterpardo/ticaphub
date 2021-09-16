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
        'event_id'
    ];

    public function event(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
