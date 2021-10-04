<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicapProgram extends Model
{
    use HasFactory;

    protected $table = 'ticap_programs';
    protected $fillable = [
        'name',
        'path',
        'ticap_event_id',
    ];

    public function event() {
        return $this->belongsTo(TicapEvent::class, 'ticap_event_id', 'id');
    }
}
