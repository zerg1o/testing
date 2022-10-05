<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtener todas objetos image de la base de datos
        //$images = Image::orderBy('id','desc')->get();

        //obtener las imagenes con paginacion
        $posts = Post::orderBy('id','desc')->paginate(5);


        return view('home',[
            'posts'=>$posts
        ]);
    }
}
