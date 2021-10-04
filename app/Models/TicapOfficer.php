<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicapOfficer extends Model
{
    use HasFactory;

    protected $table = 'ticap_officers';
    protected $fillable = [
        'name',
        'path',
        'ticap_id'
    ];

    public function ticap() {
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
}
