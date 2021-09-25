<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicapEventFile extends Model
{
    use HasFactory;

    protected $table = 'ticap_event_files';
    protected $fillable = [
        'name',
        'path',
        'ticap_event_id'
    ];

    public function ticapEvent() {
        return $this->belongsTo(TicapEvent::class, 'ticap_event_id', 'id');
    }
}
