<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        $validate = $this->Validate($request,[
            'image_id' => 'integer|required',
            'content' => 'string|required',
        ]);

        $user = \Auth::user();

        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        //redireccion
        return redirect()->back()->with(['message'=>'Comentario publicado']);
    }

    public function delete($id){
        //obtener datos del usuario identificado
        $user = \Auth::user();

        //conseguir objeto del comentario
        $comment = Comment::find($id);
        //comprobar si es el dueño del post o del comentario

        if($user && $comment->user_id == $user->id || $comment->image->user_id == $user->id ){
            $comment->delete();
            return redirect()->back()->with(['message'=>'Comentario borrado correctamente']);
        }else{
            return redirect()->back()->with(['message'=>'Fallo al eliminar comentario']);
        }
    }
}
