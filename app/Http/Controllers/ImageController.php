<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){

        $validate = $this->Validate($request,[
            'description'=>'required',
            'image_path' => 'required',
        ]);


        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $user = \Auth::user();
        $image = new Image();
        $image->image_path = null;
        $image->description = $description;
        $image->user_id = $user->id;

        if($image_path){
            $image_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_name, File::get($image_path));
            $image->image_path = $image_name;
        }


        $image->save();

        return redirect()->route('home')->with(['message'=>'La foto ha sido subida correctamente']);
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);

        return new Response($file,200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail',['image'=>$image]);
    }

    public function delete($id){
        $user = \Auth::user();
        $image = Image::find($id);
        /* $comments = Comment::where('image_id',$id)->get(); */
        /* $likes = Like::where('image_id',$id)->get(); */

        if($image && $user && $image->post->user->id == $user->id){
            /* //eliminar comentarios
            if($comments && count($comments)>=1){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }

            //eliminar likes
            if($likes && count($likes)>=1){
                foreach($likes as $like){
                    $like->delete();
                }
            } */
            //eliminar imagen del storage
            Storage::disk('images')->delete($image->image_path);
            //eliminar image
            $image->delete();

            $message = array('message'=>'La imagen fue borrada correctamente');

        }else{
            $message = array('message'=>'Error al borrar imagen');
        }

        return redirect()->back()->with($message);
    }

    public function edit($id){
        $user = \Auth::user();
        $image = Image::find($id);

        if($user && $image && $image->user->id == $user->id){

            return view('image.edit',[
                'image'=>$image
            ]);

        }else{
            return redirect()->route('home');
        }

    }

    public function update(Request $request){
        //validar datos
        $validate = $this->Validate($request,[
            'description'=>'required|string',
        ]);
        //recibiendo datos
        $image_id = $request->input('image_id');
        $description = $request->input('description');
        $image_path = $request->file('image_path');

        //conseguir objeto image
        $image = Image::find($image_id);
        $image->description = $description;


        //subir fichero

        if($image_path){
            $image_name = time().$image_path->getClientOriginalName();

            Storage::disk('images')->put($image_name,File::get($image_path));
            $image->image_path = $image_name;
        }

        //actualizar
        $image->update();

        return redirect()->back()->with(['message'=>'Imagen actualizada correctamente']);
    }
}
