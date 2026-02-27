<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author',
        'cover_image',
        'genre',
        'status',
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
