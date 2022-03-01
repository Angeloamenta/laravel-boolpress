<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        //questa tabella si collega ad user sempre con belongTo
        return $this->belongsTo('App\User');
    }
}
