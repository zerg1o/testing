<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //Establecer las relaciones(uno a muchos/muchos a uno/uno a uno/muchos a muchos)

    //Relacion One To Many/relacion uno a muchos
   /*  public function comments(){
        //devuelve los comentarios con el id de la image
        return $this->hasMany('App\Comment')->orderBy('id','asc');
    } */

    /* public function likes(){
        return $this->hasMany('App\Like');
    } */


    //relacion de muchos a uno
   /*  public function user(){
        return $this->belongsTo('App\User','user_id');
    } */

    public function post(){
        return $this->belongsTo('App\Post','post_id');
    }

}
