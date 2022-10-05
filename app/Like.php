<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    //relacion muchos a uno (belongsTo)
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    //relacion muchos a uno (belongsTo)
    public function post(){
        return $this->belongsTo('App\Post','post_id');
    }
}
