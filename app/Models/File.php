<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'name',
        'task_id',
        'event_id',
        'activity_id',
    ];

    public function activity() {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }
}
