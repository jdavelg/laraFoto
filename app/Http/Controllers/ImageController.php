<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use Illuminate\Http\Response;
use App\Comment;
use App\Like;

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
        //validacion
        $validate=$this->validate($request, [
            'description'=>'required',
            'image_path'=>'required|image'
            
        ]);
        
        //recoger datos
        
        $image_path=$request->file('image_path');
        $description=$request->input('description');
        
        //asignar valores al objeto
        $user= \Auth::user();
        $image= new Image();
        $image->user_id=$user->id;
        
        $image->description= $description;
        
        // SUBIR IMAGEN
        if($image_path){
            $image_path_name= time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path= $image_path_name;
//            $image->created_at= 'current_time()';
//            $image->updated_at= 'current_time()';
        }
        
        $image->save();
        return redirect()->route('home')->with([
            'message'=>'La foto ha sido subida correctamente'
        ]);
    }
    public function getImage($filename) {
        $file= Storage::disk('images')->get($filename);
        return new Response($file,200);
    }
    
    public function detail($id){
        $image= Image::find($id);
                return view('image.detail',[
                    'image'=>$image
                ]);
    }
    public function delete($id){
         $user= \Auth::user();
         $image= Image::find($id);
         $comments=Comment::where('image_id', $id)->get();
         $likes=Like::where('image_id', $id)->get();
         
         
         
         if($user && $image && $image->user->id == $user->id){
             //eliminar los comentarios
             if($comments && count($comments)>=1){
                 foreach($comment as $comment){
                     $comment->delete();
                 }
                 
             }
             
             //eliminar los likes
             if($likes&& count($likes)>=1){
                 foreach($likes as $like){
                     $like->delete();
                 }
                 
             }
             
             
             //eliminar los ficheros asociados de imagen
             Storage::disk('images')->delete($image->image_path);
             
             
             //eliminar imagen
             $image->delete();
              $message=array('message'=>'la imagen se ha borrado con exito');
         }else{
             $message=array('message'=>'la imagen no se ha borrado');
         }
         return redirect()->route('home')->with($message);
    }
    
    
    public function edit($id){
        $user= \Auth::user();
        $image= Image::find($id);
        
        if($user && $image && $image->user->id == $user->id){
            return view('image.edit',['image'=> $image]);
        }else{
            return redirect('home');
        }
    }
    public function update(Request $request){
        //validacion
        $validate=$this->validate($request, [
            'description'=>'required',
            'image_path'=>'image'
            
        ]);
        
        //recoger datos
        
        $image_id= $request->input('image_id');
        $image_path=$request->file('image_path');
        $description= $request->input('description');
        
        //conseguir objeto image
        $image= Image::find($image_id);
        $image->description=$description;
        
        
        
          // SUBIR IMAGEN
        if($image_path){
            $image_path_name= time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path= $image_path_name;
//            $image->created_at= 'current_time()';
//            $image->updated_at= 'current_time()';
        }
        //actualizar registro
        $image->update();
        return redirect()->route('image.detail',['id'=>$image_id])->with(['message'=>'imagen actualizada con exito']);
                
    }
}
