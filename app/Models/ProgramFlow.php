<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramFlow extends Model
{
    use HasFactory;

    protected $table = 'program_flow';
    protected $fillable = [
        'title',
        'description',
        'event_id'
    ];

    public function programs() {
        return $this->hasMany(ProgramFlowFile::class, 'program_flow_id', 'id');
    }
    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
