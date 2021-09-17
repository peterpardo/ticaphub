<?php

namespace App\Models;

use App\Http\Controllers\ListController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'ticap_id'
    ];

    public function lists() {
        return $this->hasMany(TaskList::class, 'event_id', 'id');
    }
}
