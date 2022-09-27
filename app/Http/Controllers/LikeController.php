<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Like;

class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = \Auth::user();
        $likes = Like::where('user_id',$user->id)->orderBy('id','desc')
                            ->paginate(5);
        return view('like.index',['likes'=>$likes]);
    }

    public function like($image_id){
        //recoger datos del usuario e imagen
        $user = \Auth::user();
        $like = new Like();

        $like->user_id = $user->id;
        $like->image_id = (int) $image_id;

        //verificar si el usuario ya dio like a la imagen
        $verify = Like::where('user_id',$user->id)
                        ->where('image_id',$image_id)->count();

        if($verify == 0){
            //guardar
            $like->save();
            return response()->json([
                'like'=>$like
            ]);
        }else{
            return response()->json([
                'message'=>'El like ya existe'
            ]);
        }



    }

    public function dislike($image_id){
        //recoger datos del usuario e imagen
        $user = \Auth::user();


        //verificar si el usuario ya dio like a la imagen
        $like = Like::where('user_id',$user->id)
                        ->where('image_id',$image_id)->first();

        if($like){
            //guardar
            $like->delete();
            return response()->json([
                'like'=>$like,
                'message'=>'Has dado dislike'
            ]);
        }else{
            return response()->json([
                'message'=>'El like no existe'
            ]);
        }
    }
}
