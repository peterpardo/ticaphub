<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramFlow extends Model
{
    use HasFactory;

    protected $table = 'program_flow';
    protected $fillable = [
        'name',
        'path',
        'event_id'
    ];

    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
