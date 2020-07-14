@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif

            @foreach($images as $image)



            <div class="card">
                <div class="card-header">
                    @if($image->user->image)
                    <div style="display: block;">
                        <a class="navbar-brand" style="padding-top: 10px; float: left; line-height: 0px"  href="#">
                            <img  src="{{route('user.avatar',['filename'=>$image->user->image])}}"  class="rounded-circle" width="25px"  alt="auto">
                        </a>
                    </div>
                    @endif
                    <div class="container" style="line-height: 35px; font-weight: bold">
                        <a style="color: black" href="{{ route('profile',['id'=>$image->user->id])}}">
                            {{ $image->user->name.' '. $image->user->surname}}
                            <span style="color: #6f1C00; font-style: italic"> {{'@'.$image->user->nick}}</span>
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ route('image.file',['filename'=>$image->image_path])   }}"/>
                    </div>
                </div>

                <div class="description">

                    <span style="color: #6f1C00; font-style: italic" class="nickname">{{'@'.$image->user->nick.'  '}}</span>  
                    <span style="color: black; font-style: italic" class="nickname">{{\Carbon\Carbon::now()->diffForHumans($image->create_at)}}</span>
                    <p>{{$image->description}}</p>
                </div>
                <div class="row likeand">


                    <div class="likes">

                        <?php $user_like = false; ?>
                        <!--                        comprobar si existe el like-->
                        @foreach($image->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                        <?php $user_like = true; ?>
                        @endif
                        @endforeach

                        @if($user_like)
                        <img src="{{asset('img/rojo.png')}}" id="{{$image->id}}" class="btn-dislike">
                        @else
                        <img src="{{asset('img/gray.png')}}" id="{{$image->id}}" class="btn-like">
                        @endif
                        <span class="number_likes">{{count($image->likes)}}</span>
                    </div>
                    <div class="comments">
                        <a  href="{{ route('image.detail',['id'=>$image->id])}}" type="button" class="btn btn-sm btn-warning btn-comments">
                            comentarios ({{count($image->comments)}})
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            <!--paginacion-->
            <div class="clearfix pagination justify-content-center">
                {{$images->links()}}
            </div>
        </div>


    </div>

</div>
@endsection
