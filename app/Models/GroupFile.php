<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupFile extends Model
{
    use HasFactory;

    protected $table = 'group_files';
    protected $fillable = [
        'name',
        'path',
        'group_id'
    ];

    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
    
}
