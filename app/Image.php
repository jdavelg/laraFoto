<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  public $timestamps = false;
    //definir a cual tabla se refiere
    protected $table= 'images';
//    protected $filiable=['user_id','description','image_path','updated_at','created_at'];
    //relacion One to many
    
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id','DESC');
    }
    
    //relacion One to Many
    
    public function likes(){
        return $this->hasMany('App\Like');
                
    }
    //relacion de Muchos a uno
    
    public function user(){
        return $this->belongsTo('App\User','user_id' );
    }
    
}
