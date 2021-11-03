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
        'banner_name',
        'banner_path',
        'video_name',
        'video_path',
        'group_id',
        'ticap_id',
    ];

    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
    public function ticap() {
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
}
