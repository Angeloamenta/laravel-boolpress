<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at'
    ];
    // la funzione deve avere il nome corretto altrimenti quando verrà chiamata in show restiuirà errore
    public function posts()
    {
        //questa tabella si collega a post con hasMany
        return $this->hasMany('App\Model\Post');
    }
}
