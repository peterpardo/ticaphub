<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
{
    use HasFactory;

    protected $table = 'advisers';

    protected $fillable = [
        'name'
    ];

    public function groups() {
        return $this->hasMany(Group::class, 'adviser_id', 'id');
    }
}
