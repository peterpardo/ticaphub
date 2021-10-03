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
    public function ticap() {
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
    public function files() {
        return $this->hasMany(File::class, 'event_id', 'id');
    }
    public function programFlows() {
        return $this->hasMany(ProgramFlow::class, 'event_id', 'id');
    }
}
