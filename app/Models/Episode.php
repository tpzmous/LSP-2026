<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'comic_id',
        'episode_number',
        'title',
        'pdf_file',
    ];

    public function comic()
    {
        return $this->belongsTo(Comic::class);
    }
}
