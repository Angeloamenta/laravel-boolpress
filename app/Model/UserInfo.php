<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //metodo user rappresenta la relazione di dipendenza verso il 
    // model User
    public function user()
    {
        // nel model secondario si mette la relazione 
        // belongsTo()
        return $this->belongsTo('App\User'); 
        // un user info avrà un solo user
    }
}
