@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 style="text-align: center; font-style: initial">Personas</h1>
            <br>
            <nav class="navbar navbar-light bg-light col-md-6">
                <form action="{{route('user.index')}}" class="form-inline" method="GET" id="buscador">
                    <input class="form-control mr-sm-2"  id="search" type="search" placeholder="Buscar personas.." aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </nav>
            <br>
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif

            @foreach($users as $user)

            <div class="data-user">

                @if($user->image)
                <div class="col-md-4" style="display: block;">
                    <a class="navbar-brand" style="padding-top: 10px; float: left; line-height: 0px"  href="#">
                        <img  src="{{route('user.avatar',['filename'=>$user->image])}}"  class="rounded-circle border border-info" width="100px"  height="100px" alt="auto">
                    </a>
                </div>
                @endif
            </div>

            <div class="col-md-8">
                <h2> {{'@'.$user->nick}}</h2>  
                <h3>{{$user->name.' '.$user->surname}}</h3>
                <h4 style="font-style: italic; font-size: small">{{'Se unio a Larafoto '.\Carbon\Carbon::now()->diffForHumans($user->create_at)}}</h4>
                <a href="{{  route('profile',['id'=>$user->id])  }}" class="btn btn-success">Ver perfil</a>
            </div>
            <hr>
            <br>
            <br>

            @endforeach



            <!--paginacion-->
            <div class="clearfix pagination justify-content-center">
                {{$users->links()}}
            </div>
        </div>


    </div>

</div>
@endsection


