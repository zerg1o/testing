<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use App\Image;

Route::get('/', function () {
/*
    $images = Image::all();
    echo "<h1>Imagenes</h1>";
    foreach($images as $image){
        echo "Name:".$image->image_path . "<br>";
        echo "User: ".$image->user->name." ".$image->user->surname."<br>";
        echo "Likes: ".count($image->likes);

        echo "<h2>Comments</h2>";

        if(count($image->comments)>=1){
            foreach($image->comments as $comment){
                echo $comment->user->name." ".$comment->user->surname.": ".$comment->content."<br>";
            }

        }
        echo "<hr>";

    }

    die();
    */
    return view('welcome');
});
//GENERALES
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
//USUARIOS
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/profile/{id}','UserController@profile')->name('profile');
Route::get('/users/{user?}','UserController@index')->name('user.index');

//IMAGE
Route::get('/image/create','ImageController@create')->name('image.create');
Route::post('/image/save','ImageController@save')->name('image.save');
Route::get('/image/file/{filename}','ImageController@getImage')->name('image.file');
Route::get('/image/{id}','ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}','ImageController@delete')->name('image.delete');
Route::get('/image/edit/{id}','ImageController@edit')->name('image.edit');
Route::post('/image/update','ImageController@update')->name('image.update');

//POST
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post/save','PostController@save')->name('post.save');
Route::get('/post/{id}','PostController@detail')->name('post.detail');
Route::get('/post/edit/{id}','PostController@edit')->name('post.edit');
Route::post('/post/update','PostController@update')->name('post.update');


//COMMENT
Route::post('comment/save','CommentController@save')->name('comment.save');
Route::get('comment/delete/{id}','CommentController@delete')->name('comment.delete');

//LIKE
Route::get('like/{image_id}','LikeController@like')->name('like.save');
Route::get('dislike/{image_id}','LikeController@dislike')->name('like.delete');
Route::get('/likes','LikeController@index')->name('like.index');



