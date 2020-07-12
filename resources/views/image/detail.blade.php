@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif





            <div class="card">
                <div class="card-header">
                    @if($image->user->image)
                    <div style="display: block;">
                        <a class="navbar-brand" style="padding-top: 10px; float: left; line-height: 0px"  href="#">
                            <img   src="{{route('user.avatar',['filename'=>$image->user->image])}}"  class="rounded-circle" width="25px"  alt="auto">
                        </a>
                    </div>
                    @endif
                    <div class="container" style="line-height: 35px; font-weight: bold">
                        <a href="{{ route('profile',['id'=>$image->user->id])}}"> {{ $image->user->name.' '. $image->user->surname}}</a>
                        <span style="color: #6f1C00; font-style: italic"> {{'@'.$image->user->nick}}</span>
                    </div>

                </div>

                <div class="card-body">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ route('image.file',['filename'=>$image->image_path])   }}"/>
                    </div>
                </div>

                <div class="description">
                    <span style="color: #6f1C00; font-style: italic" class="nickname">{{'@'.$image->user->nick}}</span>   
                    <span style="color: black; font-style: italic" class="nickname">{{\Carbon\Carbon::now()->diffForHumans($image->create_at)}}</span>
                    <p>{{$image->description}}</p>
                </div>
                <div class="row likeand">
                    <div class="likes">

                        <?php $user_like = false; ?>
                        <!--                        comprobar si existe el like-->
                        @foreach($image->likes as $like)
                        @if($like->user->id== Auth::user()->id)
                        <?php $user_like = true; ?>
                        @endif
                        @endforeach

                        @if($user_like)
                        <img src="{{asset('img/rojo.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                        @else
                        <img src="{{asset('img/gray.png')}}" data-id="{{$image->id}}" class="btn-like">
                        @endif
                        <span class="number_likes">{{count($image->likes)}}</span>

                    </div>
                    @if(Auth::user() && Auth::user()->id== $image->user->id)
                    <div class="actions">
                        <a href="{{route('image.edit',['id'=>$image->id])}}"  class="btn btn-sm btn-primary">Actualizar</a>    
                         
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
  Eliminar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Eliminar </h5>
        
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
       realmente desea eliminar la imagen? esta accion no se puede deshacer..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a href="{{route('image.delete',['id'=> $image->id])}}"  class="btn btn-danger">Eliminar</a>
      </div>
    </div>
  </div>
</div>
                    </div>
                    @endif
                </div>

                <div class="clearfix"></div>
                <br>
                <div class="comentarios" style="margin-left: 45px">

                    <h2>comentarios ({{count($image->comments)}})</h2>
                    <hr>
                    <div class="row">
                        <form method="POST" action="{{action('CommentController@save')}}">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}"/>

                            <textarea style="width: 167%; resize: both;" class="border border-success"  name="content" placeholder="Comenta esta Foto" required >
                                
                            </textarea>

                            <input type="submit" style="margin-top: 3px"class="btn btn-success" value="enviar">


                        </form>
                    </div>


                    <br/>
                    @foreach($image->comments as $comment)

                    <div class="comment">

                        <span style=" font-style: italic" class="nickname">{{'@'.$comment->user->nick}}</span>   
                        <span style="color: black; font-style: italic" class="nickname">{{\Carbon\Carbon::now()->diffForHumans($comment->create_at)}}</span>
                        <p>{{$comment->content}}<br/>
                            @if(Auth::check() && ($comment->user_id== Auth::user()->id|| $comment->image->user_id==Auth::user()->id ))
                            <a href="{{route('comment.delete',['id'=>$comment->id])}}" class="btn btn-sm btn-danger">Eliminar</a>
                        </p>
                        @endif
                    </div>
                    @endforeach

                </div>

            </div>


        </div>


    </div>

</div>
@endsection




