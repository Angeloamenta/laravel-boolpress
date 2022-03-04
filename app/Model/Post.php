<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id',
        'category_id',
        'created_at',
        'updated_at',
    ];

     /**
     * Get the route key for the model.
     *
     * @return string
     */

     // questa funzione serve per lo slug nella uri
    public function getRouteKeyName()
    {
        return 'slug';
    }  

    public function user()
    {
        //questa tabella si collega ad user sempre con belongTo
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        //questa tabella si collega ad category  con belongTo 
        return $this->belongsTo('App\Model\Category');
    }

    public function tags()
    {
        //creo collegamento con i tags e faccio la stessa cosa su post
        return $this->belongsToMany('App\Model\Tag');
    }
}
