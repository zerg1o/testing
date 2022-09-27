<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;
class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($user = null){

        if($user!=null){

            $users = User::where('nick','like','%'.$user.'%')
                            ->orWhere('name','like','%'.$user.'%')
                            ->orWhere('surname','like','%'.$user.'%')
                            ->orderBy('id','desc')->paginate(5);

        }else{

            $users = User::orderBy('id','desc')->paginate(5);

        }


        return view('user.users',[
            'users'=>$users
        ]);
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        $user = \Auth::user();
        $id = $user->id;
        $validate = $this->Validate($request,[
            'name' => 'required|string|max:255|regex:/^[a-z,A-Z ]+$/',
            'surname' => 'required|string|max:255|regex:/^[a-z,A-Z ]+$/',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);


        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        $user->name = $name;
        $user->surname = $surname;
        $user->email = $email;
        $user->nick = $nick;

        //recibir imagen del formulario
        $image_path = $request->file('image_path');
        if($image_path){
            $image_name = time().$image_path->getClientOriginalName();

            Storage::disk('users')->put($image_name, File::get($image_path));
            $user->image = $image_name;
        }

        $bol = $user->update();

        if($bol){
            return redirect()->route('config')->with(['message'=>'Datos actualizados correctamente']);
        }else{
            return redirect()->route('config')->with(['message'=>'Fallo al actualizar datos']);
        }

    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new  Response($file,200);
    }

    public function profile($id){
        $user = User::find($id);
        return view('user.profile',[
            'user'=>$user
        ]);
    }


}
