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

}
