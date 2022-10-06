<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Post;
use App\Image;
class PostController extends Controller
{
    //
    public function create(){
        return view('post.create');
    }


    public function save(Request $request){

        $validate = $this->Validate($request,[
            'description'=>'required',
            'image_path' => 'required',
        ]);


        $image_paths = $request->file('image_path');
        $description = $request->input('description');

        /* dump($image_path);
        die(); */
        $user = \Auth::user();
        $post = new Post();
        //$post->image_path = null;
        $post->description = $description;
        $post->user_id = $user->id;
        $post->save();

        if($image_paths){
            foreach($image_paths as $image_path){
                $image_name = time().$image_path->getClientOriginalName();
                Storage::disk('images')->put($image_name, File::get($image_path));
                $image = new Image();
                $image->post_id = $post->id;
                $image->image_path = $image_name;
                $image->save();
            }

        }

        return redirect()->route('home')->with(['message'=>'La publicacion ha sido subida correctamente']);
    }

    public function detail($id){
        $post = Post::find($id);

        return view('post.detail',['post'=>$post]);
    }


    public function edit($id){
        $user = \Auth::user();
        $post = Post::find($id);

        if($user && $post && $post->user->id == $user->id){

            return view('post.edit',[
                'post'=>$post
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
        $post_id = $request->input('post_id');
        $description = $request->input('description');
        $image_paths = $request->file('image_path');

        //conseguir objeto image
        $post = Post::find($post_id);
        $post->description = $description;


        //subir fichero

        if($image_paths){
            foreach($image_paths as $image_path){
                $image_name = time().$image_path->getClientOriginalName();
                Storage::disk('images')->put($image_name, File::get($image_path));
                $image = new Image();
                $image->post_id = $post->id;
                $image->image_path = $image_name;
                $image->save();
            }

        }

        //actualizar
        $post->update();

        return redirect()->back()->with(['message'=>'Publicacion actualizada correctamente']);
    }

}
