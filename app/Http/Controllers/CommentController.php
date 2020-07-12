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
        //validacion
        $validator= $this->validate($request, [
            'image_id'=>'integer|required',
                'content'=>'string|required'
        ]);
        
        
        //recoger datos
        $user= \Auth::user();
        $image_id=$request->input('image_id');
        $content= $request->input('content');
        
        //asignar valores a objeto a guardar
        $comment=new Comment();
        $comment->user_id= $user->id;
        $comment->image_id= $image_id;
        $comment->content=$content;
        
        //guardar en la DB
        $comment->save();
        
        //redireccionar
        return redirect()->route('image.detail',['id'=>$image_id])
                ->with([
                    'message'=>'has publicado tu comentario correctamente'
                ]);
    }
    
    public function delete($id){
        // conseguir datos del usuario identificado
        $user=\Auth::user();
        
        //conseguir datos y objeto de comentario
        $comment= Comment::find($id);
        
        //comprobar si soy el duelo del comentario o de la publicacion
        if($user && ($comment->user_id== $user->id|| $comment->image->user_id==$user->id )){
            //eliminar
            $comment->delete();
          
            //redirigir
             return redirect()->route('image.detail',['id'=>$comment->image->id])
                ->with([
                    'message'=>'comentario eliminado correctamente'
                ]);
            
        }else {
             return redirect()->route('image.detail',['id'=>$comment->image->id])
                ->with([
                    'message'=>'el comentario no se pudo eliminar'
                ]);
            
        }
    }
}
