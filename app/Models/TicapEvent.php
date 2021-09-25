<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicapEvent extends Model
{
    use HasFactory;

    protected $table = 'ticap_events';
    protected $fillable = [
        'name',
        'ticap_id'
    ];

    public function ticap() {
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
    public function archivedFiles() {
        return $this->hasMany(TicapEventFile::class, 'ticap_event_id', 'id');
    }
}
