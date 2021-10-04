<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicapExhibitFile extends Model
{
    use HasFactory;

    protected $table = 'ticap_exhibit_files';
    protected $fillable = [
        'name',
        'path',
        'ticap_exhibit_id',
    ];

    public function exhibit() {
        return $this->belongsTo(TicapExhibit::class, 'ticap_exhibit_id', 'id');
    }
}
