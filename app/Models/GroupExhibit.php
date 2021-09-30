<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupExhibit extends Model
{
    use HasFactory;

    protected $table = 'group_exhibit';
    protected $fillable = [
        'title',
        'description',
        'hero_file',
        'video_file',
        'group_id',
        'ticap_id',
    ];

    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
