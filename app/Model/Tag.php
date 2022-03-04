<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        //collegamento con post
        return $this->belongsToMany('App\Model\Post');
    }
}
