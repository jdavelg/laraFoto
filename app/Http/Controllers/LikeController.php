<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
/* use Illuminate\Support\Facades\Auth; */



class LikeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
     public function index(){
         $user= \Auth::user();
        $likes=  Like::where('user_id',$user->id)->orderBy('id','desc')
                ->paginate(5);
        
        return view('like.index',[
            'likes'=>$likes
        ]);
        
    }

    public function like($image_id) {
        //recoger datos del usuario e imagen
        $user = \Auth::user();


        //comprobar si el like existe y no duplicarlo
        $isset_like = Like::where('user_id', $user->id)
                ->where('image_id', $image_id)
                ->count();

        if ($isset_like == 0) {

            //setear
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            //guardar en la db
            $like->save();
            return response()->json([
                        'like' => $like
            ]);
        } else {
            return response()->json([
                        'message' => 'el like ya existe'
            ]);
        }
    }

    public function dislike($image_id) {
        //recoger datos del usuario e imagen
        $user = \Auth::user();


        //comprobar si el like existe y no duplicarlo
        $like = Like::where('user_id', $user->id)
                ->where('image_id', $image_id)
                ->first();

        if ($like) {

            //borrar de la db
            $like->delete();
            return response()->json([
                        'like' => $like,
                        'message' => 'ya no te gusta esta publicacion'
            ]);
        } else {
            return response()->json([
                        'message' => 'el like no existe'
            ]);
        }
    }
   

}
