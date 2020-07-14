<?php

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Route;
//use App\Image; 
//use App\User; 
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



Route::get('/', function () {
    
//    $images= Image::all();
//    foreach ($images as $image){
//        echo $image->image_path.'<br/>';
//        echo $image->description.'<br/>';
//       var_dump($image->user->name.' '.$image->user->surname).'<br/>';
//        echo '<hr/>';
//        echo '<strong>Comentarios</strong>'.' ';
//       foreach ($image->comments as $comment){
//           echo $comment->content.'<br/>';
//             echo 'likes'.count($image->likes);
//       }
//       
//      
//    }
//    die();
    return view('welcome');
});


//RUTAS GENERALES
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


//RUTAS USUARIO
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/configuracion', 'UserController@config')->name('config');
Route::get('/profile/{id}','UserController@profile')->name('profile');
Route::get('/gente/{search?}', 'UserController@index')->name('user.index');

//rutas de Imagen
Route::get('/subir-imagen','ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'imageController@update')->name('image.update');

//rutas COMENTARIOS
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

//RUTAS LIKES
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/likes','LikeController@index')->name('likes');

