<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicapExhibit extends Model
{
    use HasFactory;

    protected $table = 'ticap_exhibits';
    protected $fillable = [
        'name',
        'ticap_id'
    ];

    public function ticap() {
        return $this->belongsTo(Ticap::class, 'ticap_id', 'id');
    }
    public function files() {
        return $this->hasMany(TicapExhibitFile::class, 'ticap_exhibit_id', 'id');
    }
}
