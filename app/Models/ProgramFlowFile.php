<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramFlowFile extends Model
{
    use HasFactory;

    protected $table = 'program_flow_files';
    protected $fillable = [
        'name',
        'path',
        'program_flow_id',
        'event_id'
    ];

    public function programFlow() {
        return $this->belongsTo(ProgramFlow::class, 'program_flow_id', 'id');
    }
    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
